<?php

namespace App\Http\Controllers;

use App\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Customer;
use App\ShopContent;
use App\Advertisement;
use App\Sale;
use Session;
use DB;
use DateTime;
//use Illuminate\Support\Facades\Cache;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads1 = Advertisement::where('id',1)->first();$ads2 = Advertisement::where('id',2)->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.customer.add',compact('logo','ads1','ads2'));
    }

    public function manage()
    {
        $ads1 = Advertisement::where('id',1)->first(); $id = Session::get('loggedUser')['ring']; $total = 0; $paid = 0; $due = 0;
        $datas = Sale::select('cus_name','cus_mobile','status', DB::raw('sum(grand_total) as grand_total'), DB::raw('sum(paid) as paid'), DB::raw('sum(remaining) as due'),
            DB::raw('count(status) as inv_no'))->where([['shop_id',$id],['status','!=',null]])->groupBy(['status','cus_name','cus_mobile'])->get();
        foreach ($datas as $key => $value) {
            $data1 = array( $total = $total + $datas[$key]['grand_total']); $data2 = array( $paid = $paid + $datas[$key]['paid']);
            $data3 = array( $due = $due + $datas[$key]['due']);
        }
       /* $shows = Cache::remember('customers', 10, function () {
            return Customer::where('shop_id', Session::get('loggedUser')['ring'])->get();
        }); dump($shows);*/
//        $numbers = Sale::select('status', DB::raw('count(paid) as pay'), DB::raw('SUM(remaining) as due'))
//            ->groupBy('status')->where('shop_id', Session::get('loggedUser')['ring'])->get(['paid','remaining']);
        $logo = ShopContent::where('shop_id',$id)->first(['logo','currency']);
        return view('company.customer.manage',compact('logo','ads1','total','paid','due'));
    }

    public function customer_getData()
    {
//        ->addColumn('id')
//        ->editColumn('id', 'ID: {{data of another model}}')
        $id = Session::get('loggedUser')['ring'];
        $show = Customer::where('shop_id', $id)->orderBy('created_at','DESC')->get();
        return DataTables::of($show)->addColumn('option',function ($show){
            return '<button type="button" class="new-customer-button green-button" data-name="'.$show->name.'" data-mobile="'.$show->mobile.'"
                    data-email="'.$show->email.'" data-address="'.$show->address.'" data-toggle="modal" data-target="#view">
                    <i class="far fa-edit margin-right-css"></i>View </button>
                    <button type="button" class="new-customer-button" data-id="'.$show->id.'" data-name="'.$show->name.'" data-mobile="'.$show->mobile.'"
                    data-email="'.$show->email.'" data-address="'.$show->address.'" data-toggle="modal" data-target="#edit"><i
                    class="far fa-edit margin-right-css"></i>Edit </button>
                    <button type="button" class="new-customer-button red-button" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete">
                    <i class="far fa-trash-alt margin-right-css"></i>Delete </button>';
        })->setRowAttr(['align' => 'center'])->rawColumns(['option'])->make(true);
    }

    public function customer_invoice_getData()
    {
        $id = Session::get('loggedUser')['ring'];
        $show = Sale::select('cus_name','cus_mobile','status', DB::raw('sum(grand_total) as grand_total'), DB::raw('sum(paid) as paid'), DB::raw('sum(remaining) as due'),
            DB::raw('count(status) as inv_no'))->where([['shop_id',$id],['status','!=',null]])->groupBy(['status','cus_name','cus_mobile'])->get();
        return DataTables::of($show)->setRowAttr(['align' => 'center'])->make(true);
    }

    public function credit()
    {
        $id =  Session::get('loggedUser')['ring'];$ads1 = Advertisement::where('id',1)->first();
        $total = Sale::where([ ['shop_id', $id],['status', '!=', null],['remaining','!=', 0] ])->sum('grand_total');
        $paid = Sale::where([ ['shop_id', $id],['status', '!=', null],['remaining','!=', 0] ])->sum('paid');
        $due = Sale::where([ ['shop_id', $id],['status', '!=', null],['remaining','!=', 0] ])->sum('remaining');
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        return view('company.customer.credit',compact('logo','ads1','total','paid','due'));
    }

    public function credit_getData()
    {
        $id = Session::get('loggedUser')['ring'];
        $show = Sale::where([ ['shop_id', $id],['status', '!=', null],['remaining','!=', 0] ])->orderBy('created_at','DESC')->get();
        return DataTables::of($show)->addColumn('option',function ($show){
            return '  <button type="button" class="new-customer-button light-blue-button" data-id="'.$show->id.'" data-due="'.$show->remaining.'" 
                      data-toggle="modal" data-target="#pay"><i class="far fa-edit mr-1 green-button"></i>Pay</button>
                    <button type="button" class="new-customer-button green-button" data-cus_name="'.$show->cus_name.'" data-sales_no="'.$show->sales_no.'"
                        data-date="'.$show->date.'" data-grand_total="'.$show->grand_total.'" data-paid="'.$show->paid.'" data-remaining="'.$show->remaining.'"
                        data-toggle="modal" data-target="#cus-view"><i class="far fa-eye margin-right-css"></i>View</button>
                    <button type="button" class="new-customer-button red-button" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete">
                        <i class="far fa-trash-alt margin-right-css"></i>Delete</button>
                    <form action="'.route('sl-invoice').'" method="post" target="_blank">'. csrf_field() .'
                        <input type="hidden" name="invoice_id" value="'.$show->sales_no.'">
                        <button type="submit" style="margin-bottom:-3px;" class="new-customer-button light-blue-button mt-1">Invoice</button></form>';
        })->setRowAttr(['align' => 'center'])->rawColumns(['option'])->make(true);
    }

    public function paid()
    {
        $id =  Session::get('loggedUser')['ring'];$ads1 = Advertisement::where('id',1)->first();
        $total = Sale::where([ ['shop_id', $id],['status', '!=', null],['remaining', 0] ])->sum('grand_total');
        $paid = Sale::where([ ['shop_id', $id],['status', '!=', null],['remaining', 0] ])->sum('paid');
        $due = Sale::where([ ['shop_id', $id],['status', '!=', null],['remaining', 0] ])->sum('remaining');
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        return view('company.customer.paid',compact('logo','ads1','total','paid','due'));
    }

    public function paid_getData()
    {
        $id = Session::get('loggedUser')['ring'];
        $show = Sale::where([ ['shop_id', $id],['status', '!=', null],['remaining', 0] ])->orderBy('created_at','DESC')->get();
        return DataTables::of($show)->addColumn('option',function ($show){
            return '  <button type="button" class="new-customer-button green-button" data-cus_name="'.$show->cus_name.'" data-sales_no="'.$show->sales_no.'"
                        data-date="'.$show->date.'" data-grand_total="'.$show->grand_total.'" data-paid="'.$show->paid.'" data-remaining="'.$show->remaining.'"
                        data-toggle="modal" data-target="#cus-view"><i class="far fa-eye margin-right-css"></i>View </button>
                    <button type="button" class="new-customer-button red-button" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete">
                        <i class="far fa-trash-alt margin-right-css"></i>Delete</button>
                    <form action="'.route('sl-invoice').'" method="post" target="_blank">'. csrf_field() .'
                        <input type="hidden" name="invoice_id" value="'.$show->sales_no.'">
                        <button type="submit" style="margin-bottom:-3px;" class="new-customer-button light-blue-button mt-1">Invoice</button>
                    </form>';
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/', 'mobile' => 'required|min:11|numeric',
            'address' => 'nullable|regex:/^[0-9A-Za-z .\-_~`!%^&*={}()#;:?><’"@$+-,]+$/',
        ]);

        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $data = [
            'shop_id' => Session::get('loggedUser')['ring'], 'name' => $request->name, 'mobile' => $request->mobile, 'email' => $request->email,
            'address' => $request->address, 'created_at' => now(), 'updated_at' => now()
        ];
        Customer::insert($data);
        $notification = array('message' => 'New Customer Added Successfully', 'alert-type' => 'success');
        return back()->with($notification);
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
        $update = Customer::find($request->id); $update->name = $request->name; $update->mobile = $request->mobile;
        $update->email = $request->email; $update->address = $request->address; $update->updated_at = now(); $update->save();
        $notification = array('message' => 'Customer Data Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Customer::where('id', $request->id)->update(['deleted_at' => now() ]);
        $notification = array('message' => 'Customer Data Deleted Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }
}
