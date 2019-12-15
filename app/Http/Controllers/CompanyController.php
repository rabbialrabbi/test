<?php

namespace App\Http\Controllers;

use App\Expense;
use App\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\ProductCategory;
use DateTime;
use App\Sale;
use App\Customer;
use App\Product;
use App\ShopUser;
use App\DynamicContent;
use App\Message;
use App\Advertisement;
use App\ShopContent;
use Session;
/*  dashboard, settings->company info */

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dt = new DateTime();$dt->format('Y-m-d'); $id = Session::get('loggedUser')['ring'];
        $sale = Sale::where('shop_id',$id)->count();$staff = ShopUser::where('ring',$id)->count();
        $product_category = ProductCategory::where('shop_id',$id)->count();
        $customer = Customer::where('shop_id',$id)->count(); $product = Product::where('shop_id',$id)->count();
        $exp_product = Product::whereDate('exp_date', '<', $dt)->where('shop_id',$id)->count();
        $credit_customer = Sale::where([['remaining','!=',0],['shop_id',$id]])->count();
        $stock_alert = Product::where([['qty','<', 20],['shop_id',$id]])->count();
        /*board */
        $datas = SaleItem::where('shop_id',$id)->get(); $addition = 0;
        foreach ($datas as $key => $value) {
            $data = array( $addition = $addition + $datas[$key]['purchase_cost'] * $datas[$key]['qty'] );
        }
        $stocks = Product::where('shop_id',$id)->get(); $sum_product = 0;
        foreach ($stocks as $key => $value) {
            $data1 = array( $sum_product = $sum_product + $stocks[$key]['purchase_rate'] * $stocks[$key]['qty'] );
        }
        $total_sum = SaleItem::where('shop_id',$id)->sum('total'); $total_expense = Expense::where('shop_id',$id)->sum('paid');
        $sum_paid = Sale::where('shop_id',$id)->sum('paid');
        $sum_due = Sale::where('shop_id',$id)->sum('remaining');
        $sum_discount = SaleItem::where('shop_id',$id)->sum('discount_cost');
        $sum_expense = Expense::where('shop_id',$id)->sum('paid');
        $sum_revenue = ($total_sum - $addition) - $total_expense;

        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        $ads1 = Advertisement::where('id',1)->first();$ads2 = Advertisement::where('id',2)->first();
        return view('company.index',
            compact('product_category','customer','product','exp_product','staff','sale','ads1','ads2',
                'credit_customer','stock_alert','logo','sum_product','sum_paid','sum_due','sum_expense','sum_discount','sum_revenue'));
    }
    public function getData()
    {
        $id = Session::get('loggedUser')['ring'];
        $sales = Sale::where('shop_id',$id)->orderBy('created_at','DESC')->get();
        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        if($start_date && $end_date){
            $searched = Sale::whereBetween('created_at',array($start_date,$end_date))->where('shop_id',$id)->orderBy('created_at','DESC')->get();
            $sales = $searched;
        }
        return DataTables::of($sales)->addColumn('option',function ($sales){
            if($sales->remaining == '0.00' || $sales->remaining == '0'){
                return '<button type="button" class="btn-success green-button">Paid</button>'; }
            else{ return ' <button type="button" class="btn-success red-button">Unpaid</button>'; }
        })->setRowAttr(['align' => 'center'])->rawColumns(['option'])->make(true);
    }
    public function index_search(Request $request)
    {
        //  dd($request->to);
        $dt = new DateTime();$dt->format('Y-m-d');
        $id = Session::get('loggedUser')['ring']; $start_data = $request->from; $end_data = $request->to;
        $sale = Sale::whereBetween('created_at', array($request->from, $request->to))->where('shop_id',$id)->count();
        $staff = ShopUser::where('ring',$id)->count(); $stock_alert = Product::where([['qty','<', 20],['shop_id',$id]])->count();
        $product_category = ProductCategory::whereBetween('created_at', array($request->from, $request->to))->where('shop_id',$id)->count();
        $customer = Customer::whereBetween('created_at', array($request->from, $request->to))->where('shop_id',$id)->count();
        $product = Product::whereBetween('created_at', array($request->from, $request->to))->where('shop_id',$id)->count();
        $exp_product = Product::whereBetween('created_at', array($request->from, $request->to))->whereDate('exp_date', '<', $dt)->where('shop_id',$id)->count();
        $credit_customer = Sale::whereBetween('created_at', array($request->from, $request->to))->where([['remaining','!=',0],['shop_id',$id]])->count();
        /*board */
        $datas = SaleItem::whereBetween('created_at', array($request->from, $request->to))->where('shop_id',$id)->get(); $addition = 0;
        foreach ($datas as $key => $value) {
            $data = array( $addition = $addition + $datas[$key]['purchase_cost'] * $datas[$key]['qty'] );
        }
        $total_sum = SaleItem::whereBetween('created_at', array($request->from, $request->to))->where('shop_id',$id)->sum('total');
        $total_expense = Expense::whereBetween('created_at', array($request->from, $request->to))->where('shop_id',$id)->sum('paid');
        $stocks = Product::whereBetween('created_at', array($request->from, $request->to))->where('shop_id',$id)->get(); $sum_product = 0;
        foreach ($stocks as $key => $value) {
            $data1 = array( $sum_product = $sum_product + $stocks[$key]['purchase_rate'] * $stocks[$key]['qty'] );
        }
        $sum_paid = Sale::whereBetween('created_at', array($request->from, $request->to))->where('shop_id',$id)->sum('paid');
        $sum_due = Sale::whereBetween('created_at', array($request->from, $request->to))->where('shop_id',$id)->sum('remaining');
        $sum_discount = SaleItem::whereBetween('created_at', array($request->from, $request->to))->where('shop_id',$id)->sum('discount_cost');
        $sum_expense = Expense::whereBetween('created_at', array($request->from, $request->to))->where('shop_id',$id)->sum('paid');
        $sum_revenue = ($total_sum - $addition) - $total_expense;
//        $sales = Sale::whereBetween('created_at', array($request->from, $request->to))->where('shop_id',$id)->orderBy('created_at','DESC')->get();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        $ads1 = Advertisement::where('id',1)->first();$ads2 = Advertisement::where('id',2)->first();
        return view('company.index', compact('product_category','customer','product','exp_product','sale','staff','credit_customer',
            'stock_alert','logo','ads1','ads2', 'sum_product','sum_paid','sum_due','sum_expense','start_data','end_data','sum_discount','sum_revenue'));
    }

    public function headerSearch(Request $request){
        $ads1 = Advertisement::where('id',1)->first(); $id = Session::get('loggedUser')['ring'];
        $logo = ShopContent::where('shop_id',$id)->first(['logo']); $total = Sale::where('shop_id', $id)->sum('grand_total');
        $paid = Sale::where('shop_id', $id)->sum('paid'); $due = Sale::where('shop_id', $id)->sum('remaining');
        $validator = Validator::make($request->all(), [ 'search' => 'required|numeric' ]);
        if ($validator->fails()) { $notification = array('message' => 'Search Only Invoice Number !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $invoice_no = $request->search;
        $invoice_info = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','address']);
        return view('company.sales.manage',compact('invoice_no','logo','ads1','total','paid','due','invoice_info'));
    }

    public function info()
    {
        $cms = ShopContent::where('shop_id', Session::get('loggedUser')['ring'])->first();
        $user = ShopUser::where('ring', Session::get('loggedUser')['ring'])->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        $ads1 = Advertisement::where('id',1)->first(); $ads2 = Advertisement::where('id',2)->first();
        return view('company.info',compact('cms','user','logo','ads1','ads2'));
    }

    public function info_update(Request $request)
    {
        $update = ShopContent::find($request->cms_id);
        $update->currency = $request->currency; $update->address = $request->address; $update->city = $request->city;
        $update->fax = $request->fax; $update->website = $request->website;
        $image = "";
        if ($request->hasFile('logo')) {
            $validator = Validator::make($request->all(), [ 'logo' => 'required|mimes:jpeg,jpg,png|max:400' ]);
            if ($validator->fails()) {
                $notification = array('message' => 'Error !! Image Type Will Be JPEG/JPG/PNG & Size Not More Than 400 KB  !', 'alert-type' => 'error');
                return back()->withErrors($validator)->withInput()->with($notification);
            }
            $destinationPath = "public/shop_logo"; $file = $request->logo; $extension = $file->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . "." . $extension; $file->move($destinationPath, $fileName);
            $image = $fileName; $update->logo = $image;
        }
        $update->updated_at = now(); $update->save();
        /* update shop_users table */
        $update_shop = ShopUser::find($request->user_id);
        $update_shop->shopname = $request->shopname; $update_shop->mobile = $request->mobile;
        $update_shop->updated_at = now(); $update_shop->save();

        $notification = array('message' => 'Information was Updated successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }


    public function payment_info()
    {
        $ads1 = Advertisement::where('id',1)->first(); $ads2 = Advertisement::where('id',2)->first();
        $show = ShopContent::where('shop_id', Session::get('loggedUser')['ring'])->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.payment_info',compact('show','logo','ads1','ads2'));
    }

    public function payment_info_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vat_charge' => 'required|numeric', 'service_charge' => 'required|numeric',
            'vat_type' => 'nullable|regex:/^[0-9A-Za-z .-_~`!%^&*={}()#;:?><’"@$+-,\\/]+$/',
            'service_type' => 'nullable|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/',
        ]);
        if ($validator->fails()) { $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }

        $update = ShopContent::find($request->id);
        $update->flag = $request->flag;$update->service_flag = $request->service_flag;$update->discount_flag = $request->discount_flag;
        $update->vat_type = $request->vat_type;$update->vat_amount = $request->vat_charge;$update->service_type = $request->service_type;
        $update->service_amount = $request->service_charge;$update->updated_at = now();$update->save();
        $notification = array('message' => 'Information was Updated successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function profile()
    {
        $ads1 = Advertisement::where('id',1)->first(); $ads2 = Advertisement::where('id',2)->first();
        $categories = DynamicContent::where('section','=',null)->get();
        $shows = ShopUser::where('id', Session::get('loggedUser')['id'])->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.profile',compact('shows','logo','ads1','ads2','categories'));
    }
    public function password(){
        $ads1 = Advertisement::where('id',1)->first(); $ads2 = Advertisement::where('id',2)->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.password',compact('logo','ads1','ads2'));
    }
    public function password_change(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required', 'old_pass' => 'required|min:6', 'password' => 'required|min:6',
        ]);
        $notification1 = array('message' => 'Wrong Email/Password! Password Will have to minimum 6 Digits', 'alert-type' => 'error');
        if ($validator->fails()){ return back()->withErrors($validator)->with($notification1)->withInput(); }
        $user = ShopUser::where('email', $request->email)->first();
        if ($request->old_email == $request->email && Hash::check($request->old_pass, $user->password)) {
            ShopUser::where('email', $request->old_email)->update(['password' => Hash::make($request->password) ]);
            $notification = array('message' => 'Password Changed Successfully', 'alert-type' => 'success');
            return back()->with($notification);
        }
        else{
            $notification = array('message' => 'Wrong Email/Password!', 'alert-type' => 'error');
            return back()->with($notification);
        }
    }

    public function support()
    {
        $ads1 = Advertisement::where('id',1)->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.support',compact('logo','ads1'));
    }

    public function support_contact(Request $request){

        $validator = Validator::make($request->all(), [
            'user_name' => 'required', 'shopname' => 'required',  'email' => 'required',
            'msg' => 'required|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/',
            'mobile' => 'nullable|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/',
        ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back() ->withErrors($validator) ->withInput()->with($notification);
        }
        $data = [
            'user_id' => $request->ring, 'user_name' => $request->user_name, 'shop_name' => $request->shopname,
            'reason' => 'support', 'send_to' => 'admin', 'msg' => $request->msg,
            'file' => $request->mobile, 'email' => $request->email,
            'created_at' => now(), 'updated_at' => now()
        ];
        Message::insert($data);
        $notification = array('message' => 'Message was sent to Admin successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function admin_message()
    {
        $ads1 = Advertisement::where('id',1)->first();
        $shows = Message::where([ ['reason','support reply'],['send_to',Session::get('loggedUser')['ring']] ])->get();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.message',compact('shows','logo','ads1'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $update = ShopUser::find($request->id);
        if(Hash::check($request->password, $update->password)) {
            $update->fname = $request->fname; $update->lname = $request->lname; $update->mobile = $request->mobile;
            $update->email = $request->email; $update->industry = $request->industry; $update->postcode = $request->postcode;
            $update->country = $request->country; $update->updated_at = now(); $update->save();
            $notification = array('message' => 'Profile Updated Successfully', 'alert-type' => 'success');
            return back()->with($notification);
        }
        else{
            $notification = array('message' => 'Password Did not matched!', 'alert-type' => 'error');
            return back()->with($notification);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $notification = array('message' => 'Log Out Successfully', 'alert-type' => 'success');
        return redirect()->route('home')->with($notification);
    }
}
