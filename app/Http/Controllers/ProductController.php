<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Input;
use App\Product;
use App\ShopContent;
use App\DynamicContent;
use App\Advertisement;
use App\ProductCategory;
use Milon\Barcode\DNS1D;
use DateTime;
use Session;
use stdClass;

class ProductController extends Controller
{

    public function index()
    {
        $shows = ProductCategory::where('shop_id',Session::get('loggedUser')['ring'])->orderBy('category','ASC')->get();;
        $units = DynamicContent::where('section','unit')->get();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        $ads1 = Advertisement::where('id',1)->first(); $ads2 = Advertisement::where('id',2)->first();
        $companies = DB::table('companies')->orderBy('company','ASC')->get();
        return view('company.product.add',compact('shows','units','logo','ads1','ads2','companies'));
    }

    public function manage()
    {
        $id = Session::get('loggedUser')['ring'];  $ads1 = Advertisement::where('id',1)->first();  $purchase = 0; $sell=0; $qty=0;
        $datas = Product::where('shop_id', $id)->get();
        foreach ($datas as $key => $value) {
            $data1 = array( $purchase = $purchase + $datas[$key]['purchase_rate'] * $datas[$key]['qty'] );
            $data2 = array( $sell = $sell + $datas[$key]['selling_rate'] * $datas[$key]['qty'] );
            $data3 = array( $qty = $qty +  $datas[$key]['qty'] );
        }
        $sales = Product::select('product_name', DB::raw('max(created_at) as sell'))->where('shop_id',$id)->groupBy('product_name')->get();
        $compares = Product::where('shop_id',$id)->get(['parent_id','selling_rate','purchase_rate','created_at']);
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        return view('company.product.manage',compact('logo','ads1','sales','compares','purchase','sell','qty'));
    }

    public function getData()
    {
        $id = Session::get('loggedUser')['ring'];
        $show = Product::where([['shop_id', $id],['parent_id', 0]])->orderBy('created_at','DESC')->get();

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        if($start_date && $end_date){
            $searched = Product::whereBetween('exp_date',array($start_date,$end_date))->where([['shop_id', $id],['parent_id',0]])
                ->orderBy('created_at','DESC')->get(); $show = $searched;
        }

        return DataTables::of($show)->addColumn('option',function ($show){
            return '<button type="button" class="new-customer-button mb-1" data-product_name="'.$show->product_name.'" data-product_category="'.$show->product_category.'"
                        data-store_in="'.$show->store_in.'" data-batch="'.$show->batch.'" data-purchase_rate="'.$show->purchase_rate.'"
                        data-selling_rate="'.$show->selling_rate.'" data-qty="'.$show->total_qty.'" data-company="'.$show->company.'"
                        data-mfg_date="'.$show->mfg_date.'" data-exp_date="'.$show->exp_date.'" data-details="'.$show->details.'"
                        data-toggle="modal" data-target="#view_product"><i class="fa fa-eye"></i> Detail</button>
                     <button  type="button" class="new-customer-button green-button mb-1" data-id="'.$show->id.'" data-product_name="'.$show->product_name.'"
                        data-product_category="'.$show->product_category.'" data-store_in="'.$show->store_in.'" data-batch="'.$show->batch.'"
                        data-purchase_rate="'.$show->purchase_rate.'" data-selling_rate="'.$show->selling_rate.'" data-qty="'.$show->qty.'"
                        data-company="'.$show->company.'" data-mfg_date="'.$show->mfg_date.'" data-exp_date="'.$show->exp_date.'" data-details="'.$show->details.'"
                        data-toggle="modal" data-target="#edit_product"><i class="fa fa-edit"></i> Edit</button>
                     <button type="button" class="new-customer-button red-button mb-1" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete"> Delete </button>
                     <form action="'.route('product-barcode').'" method="post" target="_blank"> '.csrf_field().'
                        <input type="hidden" name="id" value="'.$show->id.'">
                        <button type="submit" style="margin-bottom:-3px;" class="new-customer-button mb-1">
                            <i class="fa fa-barcode"></i></button></form>';
        })->addColumn('quantity',function ($show){ return '<span style="color: green;font-weight: bold;">'.$show->total_qty.'</span>';
        })->setRowAttr(['align' => 'center'])->rawColumns(['quantity','option'])->make(true);
    }

    public function barcode(Request $request){
        $ads1 = Advertisement::where('id',1)->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        $ids = Session::get('loggedUser')['ring']; $dt = new DateTime();$date = $dt->format('d-m-Y');
        $barcode_info = Product::where([ ['shop_id', $ids],['id', $request->id] ])->first();
        return view('custom_plugin.barcode',compact('barcode_info','date','logo','ads1'));
    }

    public function category()
    {
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        $ads1 = Advertisement::where('id',1)->first();
        return view('company.product.category',compact('logo','ads1'));
    }

    public function category_getData()
    {
        $show =ProductCategory::where('shop_id', Session::get('loggedUser')['ring'])->orderBy('created_at','DESC')->get();
        return DataTables::of($show)->addColumn('option',function ($show){
            return '<button type="button" class="new-customer-button" data-id="'.$show->id.'" data-category="'.$show->category.'"
                        data-description="'.$show->description.'" data-toggle="modal" data-target="#edit_pc"><i
                        class="far fa-edit margin-right-css"></i>Edit </button>
                <button type="button" class="new-customer-button red-button" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete">
                        <i class="far fa-trash-alt margin-right-css"></i>Delete</button>';
        })->addColumn('date',function ($show){ return $show->created_at->format('d/m/Y'); })->rawColumns(['option','date'])->make(true);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/', 'product_category' => 'required', 'batch' => 'required|regex:/^[0-9A-Za-z .-_~`!%^&*=#;:?><’"@$+-,\\/]+$/',
            'store_in' => 'nullable|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/',
            'purchase_rate' => 'required|numeric', 'selling_rate' => 'required|numeric', 'qty' => 'required|numeric',
            'company' => 'nullable|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/', 'unit'=> 'required', 'mfg_date' => 'required',
            'exp_date' => 'required', 'details' => 'nullable|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/'
        ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $data = [
            'parent_id' => '0', 'shop_id' => Session::get('loggedUser')['ring'],
            'product_name' => $request->product_name, 'product_category' => $request->product_category,
            'store_in' => $request->store_in, 'batch' => $request->batch, 'purchase_rate' => $request->purchase_rate,
            'selling_rate' => $request->selling_rate, 'qty' => $request->qty, 'unit'=> $request->unit,'total_qty' => $request->qty,
            'company' => $request->company, 'mfg_date' => $request->mfg_date, 'exp_date' => $request->exp_date,
            'details' => $request->details,'barcode' => rand(10000000, 99999999), 'created_at' => now(), 'updated_at' => now()
        ];
        $id = DB::table('products')->insertGetId( $data );
        //Product::insert($data);
        // insert into purchase table
        if($request->totalAmount == $request->payment)
        {
            $p_status= "Paid";
        }
        else
        {
            $p_status = "Unpaid";
        }
        $purchaseDataId = DB::table('purchases')->insertGetId([
            'shop_id' => Session::get('loggedUser')['ring'],
            'purchase_by' => Session::get('loggedUser')['fname'].' '.Session::get('loggedUser')['lname'],
            'purchase_id' => date('YmdHis'),
            'product_id' => $id,
            'supplier_id' => $request->product_company,
            'purchase_rate' => $request->purchase_rate,
            'selling_rate' => $request->selling_rate,
            'qty' => $request->qty,
            'total_amount' => $request->totalAmount,
            'payment' => $request->payment,
            'status' => $p_status

        ]);
        // Insert into purchase
        $paymentDetails = DB::table('purchase_payment_details')->insert([
            'purchase_id' => $purchaseDataId,
            'amount' => $request->payment,
            'payment_by' => Session::get('loggedUser')['fname'].' '.Session::get('loggedUser')['lname']
        ]);
        $notification = array('message' => 'New Product Added Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function category_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/',
            'description' => 'nullable|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/'
        ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $data = [
            'shop_id' => Session::get('loggedUser')['ring'], 'category' => $request->category, 'description' => $request->description,
            'created_at' => now(), 'updated_at' => now()
        ];
        ProductCategory::insert($data);
        $notification = array('message' => 'New Product Category Added Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function subproduct_store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric', 'batch_no' => 'required', 'purchase' => 'required|numeric', 'selling' => 'required|numeric', 'mfg' => 'required', 'exp' => 'required'
        ]);

        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $data = [
            'parent_id' => $request->parent_id, 'shop_id' => Session::get('loggedUser')['ring'],
            'product_name'=> $request->name, 'product_category'=> $request->category, 'qty' => $request->quantity,'total_qty' => $request->quantity,
            'batch' => $request->batch_no, 'purchase_rate' => $request->purchase, 'selling_rate' => $request->selling,
            'store_in' => $request->store, 'mfg_date' => $request->mfg, 'exp_date' => $request->exp,'unit' => $request->unit,
            'barcode' => rand(10000000, 99999999), 'created_at' => now(), 'updated_at' => now()
        ];
        Product::insert($data);
        $qtys = Product::where('id',$request->parent_id)->first(['total_qty']);
        Product::where('id',$request->parent_id)->update(['total_qty' => $qtys->total_qty + $request->quantity]);
        Product::where('id',$request->parent_id)->orWhere('parent_id',$request->parent_id)->update(['selling_rate' => $request->selling]);
        $notification = array('message' => 'New Item Added Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }
    // Product Company
    public function pro_company()
    {
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        $ads1 = Advertisement::where('id',1)->first();
        $show = DB::table('companies')->where('shop_id', Session::get('loggedUser')['ring'])->orderBy('created_at','DESC')->get();
        //return $show;
        return view('company.product.company',compact('logo','ads1'));
    }
    public function company_getData()
    {
        $showCompany = DB::table('companies')->where('shop_id', Session::get('loggedUser')['ring'])->where('deleted_at',NULL)->orderBy('created_at','DESC')->get();
        return DataTables::of($showCompany)->addColumn('option',function ($showCompany){
            return '<button type="button" class="new-customer-button" data-id="'.$showCompany->id.'" data-company="'.$showCompany->company.'"
                        data-billing="'.$showCompany->billing_address.'" data-phone="'.$showCompany->company_phone.'" data-email="'.$showCompany->company_email.'" data-due="'.$showCompany->due_balance.'" data-toggle="modal" data-target="#edit_proCompany"><i
                        class="far fa-edit margin-right-css"></i>Edit </button>
                <button type="button" class="new-customer-button red-button" data-id="'.$showCompany->id.'" data-toggle="modal" data-target="#delete">
                        <i class="far fa-trash-alt margin-right-css"></i>Delete</button>';
        })->addColumn('date',function ($showCompany){ return $showCompany->created_at; })->rawColumns(['option','date'])->make(true);
    }
    public function pro_company_create()
    {
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        $ads1 = Advertisement::where('id',1)->first();
        $ads2 = Advertisement::where('id',2)->first();
        return view('company.product.add_company',compact('logo','ads1','ads2'));
    }
    public function company_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company' => 'required|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/',
            'company_phone' => 'nullable|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/',
            'company_email' => 'nullable|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/',
            'billing_address' => 'nullable|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/'
        ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $data = [
            'shop_id' => Session::get('loggedUser')['ring'],
            'company'       => $request->company,
            'company_phone' => $request->phone,
            'company_email' => $request->email,
            'due_balance'   => $request->due,
            'billing_address' => $request->billing,
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('companies')->insert($data);
        $notification = array('message' => 'Product Company Added Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }
    public function company_update(Request $request)
    {
        $product_id = $request->id;
        $updateCompany = DB::table('companies')->where('id',$product_id)->update([
            'company'       => $request->company,
            'company_phone' => $request->phone,
            'company_email' => $request->email,
            'due_balance'   => $request->due,
            'billing_address' => $request->billing,
            'updated_at'    => now()
        ]);
        $notification = array('message' => 'Product Company Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }
    public function company_destroy(Request $request)
    {
        //DB::table('companies')->where('id', $request->id)->update(['deleted_at' => now()]);
        DB::table('companies')->where('id', $request->id)->delete();
        $notification = array('message' => 'Product Company Deleted Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    // Product Company End
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'purchase_rate' => 'required|numeric', 'selling_rate' => 'required|numeric']);
        if ($validator->fails()) { $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $update = Product::find($request->id); $update->product_name = $request->product_name; $update->product_category = $request->product_category;
        $update->store_in = $request->store_in; $update->batch = $request->batch; $update->purchase_rate = $request->purchase_rate;
        $update->selling_rate = $request->selling_rate; $update->company = $request->company;
        $update->mfg_date = $request->mfg_date; $update->exp_date = $request->exp_date; $update->details = $request->details;
        $update->updated_at = now(); $update->save();
        Product::where('parent_id',$request->id)->update(['selling_rate' => $request->selling_rate]);
        $notification = array('message' => 'Product Data Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function subproduct_update(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'purchase' => 'required|numeric', 'selling' => 'required|numeric']);
        if ($validator->fails()) { $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $update = Product::find($request->id); $update->qty = $request->quantity; $update->batch = $request->batch_no;
        $update->purchase_rate = $request->purchase; $update->selling_rate = $request->selling; $update->store_in = $request->store;
        $update->mfg_date = $request->mfg; $update->exp_date = $request->exp; $update->updated_at = now(); $update->save();
        Product::where('id',$update->parent_id)->orWhere('parent_id',$update->parent_id)->update(['selling_rate' => $request->selling]);
        $notification = array('message' => 'Product Item Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function category_update(Request $request)
    {
        $update = ProductCategory::find($request->id); $update->category = $request->category; $update->description = $request->description;
        $update->updated_at = now(); $update->save();
        $notification = array('message' => 'Product Category Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }


    public function category_destroy(Request $request)
    {
        ProductCategory::where('id', $request->id)->update(['deleted_at' => now()]);
        $notification = array('message' => 'Product Category Deleted Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function destroy(Request $request)
    {
        //Product::where('id', $request->id)->update(['deleted_at' => now()]);
        Product::where('id', $request->id)->delete();
        $notification = array('message' => 'Product Deleted Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

}
