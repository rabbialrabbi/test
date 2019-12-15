<?php

namespace App\Http\Controllers;

use App\Content;
use App\DynamicContent;
use App\ShopContent;
use App\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use DateTime;
use App\Advertisement;
use App\Customer;
use App\SaleItem;
use App\Sale;
use App\Product;
use Session;
use stdClass;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads1 = Advertisement::where('id',1)->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        $dt = new DateTime(); $date = $dt->format('d-m-Y'); $id = Session::get('loggedUser')['ring'];
        $cus_names = Customer::get();$mail = ShopUser::where([['ring',$id],['type','shop']])->first(['email','shopname','mobile']);
        $cms = ShopContent::where('shop_id', Session::get('loggedUser')['ring'])->first(['vat_type','service_type']);
        $invoice_id = 201900000 + Sale::where('shop_id', Session::get('loggedUser')['ring'])->withTrashed()->count();
        $invoice_info = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','address','currency','website']);
        return view('company.sales.add', compact( 'date','cms','cus_names','invoice_id','invoice_info','logo','ads1','mail'));
    }

    public function getData(){
        $products = Product::where('shop_id',Session::get('loggedUser')['ring'])->get();
        $items = Product::Orderby('product_name', 'ASC')->get(['product_name']);
        $customer = Customer::where('shop_id',Session::get('loggedUser')['ring'])->get();
        $amount = ShopContent::where('shop_id', Session::get('loggedUser')['ring'])->first(['vat_amount','service_amount','flag','service_flag','discount_flag']);
        $data = new stdClass();
        $data->products = $products; $data->items = $items; $data->customer = $customer; $data->vat = $amount;
        return response()->json($data);
    }

    public function manage()
    {
        $ads1 = Advertisement::where('id',1)->first();$id =  Session::get('loggedUser')['ring'];$dt = new DateTime(); $date = $dt->format('d-m-Y');
        $logo = ShopContent::where('shop_id',$id)->first(['logo','currency']); $total = Sale::where('shop_id', $id)->sum('grand_total');
        $paid = Sale::where('shop_id', $id)->sum('paid'); $due = Sale::where('shop_id', $id)->sum('remaining');
        $invoice_info = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','address']);
        return view('company.sales.manage',compact('invoice_info','date','logo','ads1','total','paid','due'));
    }

    public function sale_getData()
    {
        $id = Session::get('loggedUser')['ring']; $show = Sale::where('shop_id', $id)->get();
        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        $invoice = (!empty($_GET["invoice"])) ? ($_GET["invoice"]) : ('');
        if($start_date && $end_date){
            $start_date = date('d/m/Y', strtotime($start_date)); $end_date = date('d/m/Y', strtotime($end_date));
            $searched = Sale::whereBetween('date',array($start_date,$end_date))->where('shop_id', Session::get('loggedUser')['ring'])->get();
            $show = $searched;
        }
        else if($invoice){ $show = Sale::where([['shop_id', $id],['sales_no', $invoice]])->get(); }

        return DataTables::of($show)->addColumn('option',function ($show){
            return '<div class="row"><div class="col-md-3 mr-2">
                        <form action="'.route('sl-invoice').'" method="post" target="_blank">
                         '.csrf_field().'<input type="hidden" name="invoice_id" value="'.$show->sales_no.'">
                            <button type="submit" style="margin-bottom:-3px;" class="new-customer-button light-blue-button">Invoice</button>
                        </form>
                       </div><div class="col-md-3">
                            <form action="'.route('sl-return').'" method="post" target="_blank"> '.csrf_field().'
                                <input type="hidden" name="invoice_id" value="'.$show->sales_no.'">
                                <button type="submit" style="margin-bottom:-3px;" class="new-customer-button mb-1">
                                    Return</button></form>
                            </div>
                       </div>
                    <button type="button" class="new-customer-button green-button float-left" data-id="'.$show->id.'" data-cus_name="'.$show->cus_name.'"
                        data-seller="'.$show->seller.'" data-grand_total="'.$show->grand_total.'" data-toggle="modal" data-target="#edit">
                        <i class="far fa-edit margin-right-css"></i>Edit </button>
                       <!-- '.'@if(Session::get("loggedUser")["type"] === "shop1") '.'<p>11</p>'.'  @endif'.' -->
                    <button type="button" class="new-customer-button red-button float-left ml-1" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete">
                        <i class="far fa-trash-alt margin-right-css"></i>Delete</button>';
        })->addColumn('pay',function ($show){
            if($show->grand_total == $show->paid) {
                return ' <button type="button" class="new-customer-button mb-1" disabled><i class="far fa-check-circle mr-1 green-button"></i> Paid</button>';
            }
            else{
                return '<button type="button" class="new-customer-button mb-1" data-id="'.$show->id.'" data-due="'.$show->remaining.'" data-toggle="modal"
                        data-target="#pay"><i class="far fa-edit mr-1 green-button"></i> Pay </button>';
            }
        })->setRowAttr(['align' => 'center'])->rawColumns(['option','pay'])->make(true);
    }
    public function invoice(Request $request){
        $ads1 = Advertisement::where('id',1)->first(); $id = Session::get('loggedUser')['ring'];
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        $dt = new DateTime();$date = $dt->format('d-m-Y');
        $mail = ShopUser::where([['ring',$id],['type','shop']])->first(['email','shopname','mobile']);

        $sale = Sale::where([ ['shop_id', $id],['sales_no', $request->invoice_id] ])->first();
        $saleitems = SaleItem::where([ ['shop_id', $id],['sales_no', $request->invoice_id] ])->get();
        $invoice_info = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','address','currency','website']);
        return view('custom_plugin.invoice',compact('sale','saleitems','invoice_info','date','logo','ads1','mail'));
    }

    public function paid()
    {
        $ads1 = Advertisement::where('id',1)->first();$id = Session::get('loggedUser')['ring'];
        $total = Sale::where([['shop_id', $id],['remaining', 0]])->sum('grand_total');
        $paid = Sale::where([['shop_id', $id],['remaining', 0]])->sum('paid');
        $discount = Sale::where([['shop_id', $id],['remaining', 0]])->sum('total_discount');
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        return view('company.sales.paid',compact('shows','logo','ads1','total','discount','paid'));
    }

    public function paid_getData()
    {
        $show = Sale::where('shop_id', Session::get('loggedUser')['ring'])->where('remaining', 0)->get();
        return DataTables::of($show)->addColumn('option',function ($show){
            return '<button type="button" class="new-customer-button green-button" data-cus_name="'.$show->cus_name.'" data-seller="'.$show->seller.'"
                        data-date="'.$show->date.'" data-grand_total="'.$show->grand_total.'" data-total_discount="'.$show->total_discount.'"
                        data-paid="'.$show->paid.'" data-toggle="modal" data-target="#sl-view">View </button>
                <button type="button" class="new-customer-button red-button" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete">
                    <i class="far fa-trash-alt margin-right-css"></i>Delete </button>';
        })->setRowAttr(['align' => 'center'])->rawColumns(['option'])->make(true);
    }

    public function unpaid()
    {
        $ads1 = Advertisement::where('id',1)->first();$id = Session::get('loggedUser')['ring'];
        $total = Sale::where([['shop_id', $id],['remaining','!=', 0]])->sum('grand_total');
        $paid = Sale::where([['shop_id', $id],['remaining','!=', 0]])->sum('paid');
        $due = Sale::where([['shop_id', $id],['remaining','!=', 0]])->sum('remaining');
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        return view('company.sales.unpaid',compact('shows','logo','ads1','total','paid','due'));
    }

    public function unpaid_getData()
    {
        $show = Sale::where('shop_id', Session::get('loggedUser')['ring'])->where('remaining','!=', 0)->get();
        return DataTables::of($show)->addColumn('option',function ($show){

            return '<button type="button" class="sales-button light-blue-button mb-1" data-id="'.$show->id.'" data-due="'.$show->remaining.'"
                            data-toggle="modal" data-target="#pay">Pay</button>
                    <button type="button" class="new-customer-button green-button" data-cus_name="'.$show->cus_name.'" data-seller="'.$show->seller.'"
                        data-date="'.$show->date.'" data-grand_total="'.$show->grand_total.'" data-paid="'.$show->paid.'" data-remaining="'.$show->remaining.'"
                        data-toggle="modal" data-target="#sl-view">View
                    </button>
                    <button type="button" class="new-customer-button red-button" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete">Delete
                    </button>';
        })->setRowAttr(['align' => 'center'])->rawColumns(['option'])->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $data1 = (object) $request;
        if(!$data1['cus_id'] && $data1['cus_name']){
            $cus_data = [ 'shop_id' => Session::get('loggedUser')['ring'],
                'name' => $data1['cus_name'], 'mobile' =>  $data1['cus_mobile'], 'email' => $data1['cus_email'],
                'address' =>  $data1['cus_address'], 'created_at' => now(), 'updated_at' => now()
            ]; $cus_id = Customer::insertGetId($cus_data);
            $data1['cus_id'] = $cus_id;
        }
        $counts = Sale::where('shop_id', Session::get('loggedUser')['ring'])->withTrashed()->count();
        $customer = new Sale;
        $customer->shop_id = Session::get('loggedUser')['ring']; $customer->sales_no = 201900000 + $counts;
        $customer->cus_name = $data1['cus_name']; $customer->cus_mobile = $data1['cus_mobile'];
        $customer->cus_email = $data1['cus_email']; $customer->cus_address = $data1['cus_address'];
        $customer->date = $data1['cus_date']; $customer->seller = Session::get('loggedUser')['fname'];
        $customer->sub_total = $data1['sub_total']; $customer->total_discount = $data1['total_discount'];

        $customer->vat = $data1['vat']; $customer->service_charge = $data1['service'];

        if($data1['flag'] === 0) {
            $customer->vat_cost = $data1['vat'];
        }
        else{
            $customer->vat_cost = number_format(((($data1['sub_total'] * ($data1['vat'] + 100)) / 100) - $data1['sub_total']),2, '.', ',');
        }
        if($data1['service_flag'] === 0){
            $customer->service_cost = $data1['service'];
        }
        else{
            $customer->service_cost = number_format(((($data1['sub_total'] * ($data1['service'] + 100)) / 100) - $data1['sub_total']),2, '.', ',');
        }

        $customer->grand_total = $data1['grand_total'];
        $customer->paid = $data1['paid'] + 0; $customer->remaining = $data1['due']; $customer->status = $data1['cus_id'];

        if ($customer->save()) {
            $sale_no = $customer->sales_no;
            foreach ($data1['Data'] as $key => $value) {
                $data = array(
                    'sales_no' => $sale_no, 'shop_id' =>  Session::get('loggedUser')['ring'], 'item' => $data1['Data'][$key]['product_name'],
                    'item_id' => $data1['Data'][$key]['id'], 'category' => $data1['Data'][$key]['product_category'],
                    'batch_number' => $data1['Data'][$key]['batch'], 'purchase_cost' => $data1['Data'][$key]['purchase_rate'],
                    'qty' => $data1['Data'][$key]['new_qty'], 'unit' => $data1['Data'][$key]['unit'],
                    'sale_rate' => $data1['Data'][$key]['selling_rate'], 'discount' => $data1['Data'][$key]['discount'],
                    'discount_cost' =>  ($data1['Data'][$key]['selling_rate'] * $data1['Data'][$key]['new_qty']) - $data1['Data'][$key]['total'],
                    'total' => $data1['Data'][$key]['total'],
                );
                SaleItem::insert($data);
            }
            foreach ($data1['Data'] as $key => $value) {
                $match = Product::where('id', $data1['Data'][$key]['id'])->first(['parent_id']);
                $parent = Product::where('id', $match->parent_id)->first(['total_qty']);
                if($match->parent_id == 0) {
                    $data = array(
                        Product::where('id', $data1['Data'][$key]['id'])
                            ->update(['qty' => $data1['Data'][$key]['qty'] - $data1['Data'][$key]['new_qty'],
                                'total_qty' => $data1['Data'][$key]['total_qty'] - $data1['Data'][$key]['new_qty']]),
                    );
                }
                else {
                    $data = array(
                        Product::where('id', $data1['Data'][$key]['id'])
                            ->update(['qty' => $data1['Data'][$key]['qty'] - $data1['Data'][$key]['new_qty'],
                                'total_qty' => $data1['Data'][$key]['total_qty'] - $data1['Data'][$key]['new_qty']]),
                    );
                    $data2 = array(
                        Product::where('id', $match->parent_id)
                            ->update(['total_qty' => $parent->total_qty - $data1['Data'][$key]['new_qty']]),
                    );
                }

            }
        }
    }

    public function return(Request $request)
    {
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        $id = $request->invoice_id; $ads1 = Advertisement::where('id',1)->first();
        $dt = new DateTime(); $date = $dt->format('d-m-Y'); $ids = Session::get('loggedUser')['ring'];
        $invoice_id = 201900000 + Sale::where('shop_id', Session::get('loggedUser')['ring'])->withTrashed()->count();
        $invoice_info = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','address']);
        $record = Sale::where([['sales_no', $request->invoice_id],['shop_id', Session::get('loggedUser')['ring']]])->first();
        $mail = ShopUser::where([['ring',$ids],['type','shop']])->first(['email']);
        return view('company.sales.return', compact('record','invoice_info','invoice_id','date','id','logo','ads1','mail'));
    }

    public function returnData($id){
        $ids = Session::get('loggedUser')['ring']; $products = SaleItem::where([['sales_no',$id],['shop_id', $ids]])->get();
        $customer = Customer::get();
        $data = new stdClass();
        $data->products = $products; $data->customer = $customer;
        return response()->json($data);
    }

    public function return_update(Request $request){
        $data1 = (object) $request;
        $ids = Session::get('loggedUser')['ring'];
        $store = 0; $updated = 0;
            foreach ($data1['Data'] as $key => $value) {
                $update = SaleItem::find($data1['Data'][$key]['id']);
                $store = $store + $update->total;
                $update->qty = $update->qty - $data1['Data'][$key]['new_qty'];
                $update->return_data = '(returned)';
                $update->total = ($update->sale_rate * $update->qty) - ((($update->sale_rate * $update->qty) * $update->discount) / 100);
                $update->discount_cost =  ($update->sale_rate * $update->qty) - $update->total;
                $updated = $updated + $update->total; $update->updated_at = now(); $update->save();
            }
                $invoice_id =  $data1['invoice_id'];
                $updates = Sale::where([['sales_no', $invoice_id],['shop_id', $ids]])->first();


                $updates->grand_total = ($updates->grand_total - $updates->sub_total) + ($updates->sub_total - ($store - $updated));

                $updates->sub_total = $updates->sub_total - ($store - $updated);

                if($updates->sub_total == 0 || $updates->sub_total == 0.00){
                    $updates->remaining = 0; $updates->grand_total = 0; $updates->paid = 0;
                }
                else{
                    if($updates->grand_total < $updates->paid){ $updates->paid = $updates->grand_total; $updates->remaining = 0; }
                    else if ($updates->grand_total > $updates->paid){ $updates->remaining = $updates->grand_total -$updates->paid; }
                    else if($updates->grand_total == $updates->paid){ $updates->remaining = $updates->grand_total -$updates->paid; }
                }

                $updates->seller = Session::get('loggedUser')['fname']; $updates->updated_at = now(); $updates->save();

            foreach ($data1['Data'] as $key => $value) {
                    $update = Product::find($data1['Data'][$key]['item_id']);
                    $update->qty = $update->qty + $data1['Data'][$key]['new_qty'];
                    $update->updated_at = now();$update->save();
                    $prnt_id = $update->parent_id;
                if($prnt_id == 0) {
                    $info = Product::where('id', $data1['Data'][$key]['item_id'])->first(['total_qty']);
                    $data = array(
                        Product::where('id',$data1['Data'][$key]['item_id'])->update(['total_qty' => $info->total_qty + $data1['Data'][$key]['new_qty']]),
                    );
                }
                else{
                    $info = Product::where('id', $prnt_id)->first(['total_qty']);
                    $data2 = array(
                        Product::where('id', $prnt_id)->update(['total_qty' => $info->total_qty + $data1['Data'][$key]['new_qty']]),
                    );
                }


            }
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function pay(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'paid' => 'required|numeric' ]);
        if ($validator->fails()) { $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $update = Sale::find($request->id);
        if($request->paid > ($update->grand_total - $update->paid)){
            $notification = array('message' => 'Error !! Can Not Pay More Than Due Amount !', 'alert-type' => 'error');
            return back()->with($notification);
        }
        $update->paid = $update->paid + $request->paid; $update->remaining = $update->grand_total - $update->paid;
        $update->updated_at = now(); $update->save();
        $notification = array('message' => 'Saled Pay Information Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function update(Request $request)
    {
        $data = [ 'shop_id' => Session::get('loggedUser')['ring'], 'name' => $request->cus_name, 'created_at' => now(), 'updated_at' => now() ];
        $cus_id = Customer::insertGetId($data);
        $update = Sale::find($request->id);
        $update->cus_name = $request->cus_name; $update->seller = $request->seller;
        $update->status = $cus_id; $update->updated_at = now(); $update->save();
        $notification = array('message' => 'Sale Information Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Sale::where('id', $request->id)->update(['deleted_at' => now()]);
        $notification = array('message' => 'Sales Information Deleted Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }
}
