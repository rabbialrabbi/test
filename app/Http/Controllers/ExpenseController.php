<?php

namespace App\Http\Controllers;

use App\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\ExpenseType;
use App\Product;
use App\ProductCategory;
use DateTime;
use App\Expense;
use App\ExpenseItem;
use App\DynamicContent;
use App\ShopContent;
use App\Advertisement;
use App\Statement;
use Session;

// contains expense, expired part

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads1 = Advertisement::where('id',1)->first(); $ads2 = Advertisement::where('id',2)->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.expense.add',compact('logo','ads1','ads2'));
    }

    public function manage()
    {
        $ads1 = Advertisement::where('id',1)->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.expense.manage',compact('logo','ads1'));
    }

    public function expense_getData()
    {
        $show = ExpenseType::where('shop_id', Session::get('loggedUser')['ring'])->get();
        return DataTables::of($show)->addColumn('option',function ($show){
            return '<button type="button" class="new-customer-button" data-id="'.$show->id.'" data-expensetype="'.$show->type.'"
                       data-toggle="modal" data-target="#edit1"><i class="far fa-edit margin-right-css"></i>Edit</button>
                    <button type="button" class="new-customer-button red-button" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete"><i
                        class="far fa-trash-alt margin-right-css"></i>Delete</button>';
        })->setRowAttr(['align' => 'center'])->rawColumns(['option'])->make(true);
    }

    public function add_invoice()
    {
        $ads1 = Advertisement::where('id',1)->first();$dt = new DateTime();$date = $dt->format('Y-m-d');
        $shows = ExpenseType::where('shop_id', Session::get('loggedUser')['ring'])->get(['type']);
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.expense.add_invoice',compact('shows','date','logo','ads1'));
    }

    public function manage_invoice()
    {
        $id =  Session::get('loggedUser')['ring'];$ads1 = Advertisement::where('id',1)->first();
        $total = Expense::where('shop_id', $id)->sum('grand_total');$paid = Expense::where('shop_id', $id)->sum('paid');
        $due = Expense::where('shop_id', $id)->sum('due');
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        return view('company.expense.manage_invoice',compact('logo','ads1','total','paid','due'));
    }
    public function manage_expense_getData()
    {
        $show = Expense::where('shop_id', Session::get('loggedUser')['ring'])->orderBy('created_at','DESC')->get();
        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        $pay = (!empty($_GET["pay"])) ? ($_GET["pay"]) : (''); $unpay = (!empty($_GET["unpay"])) ? ($_GET["unpay"]) : ('');
        if($start_date && $end_date){
            $searched = Expense::whereBetween('date',array($start_date,$end_date))->where('shop_id', Session::get('loggedUser')['ring'])
                ->orderBy('created_at','DESC')->get(); $show = $searched;
        }
        else if($pay){
            $searched = Expense::where([ ['shop_id', Session::get('loggedUser')['ring']],['due', 0] ])->get(); $show = $searched;
        }
        else if($unpay){
            $searched = Expense::where([ ['shop_id', Session::get('loggedUser')['ring']],['due','!=', 0] ])->get(); $show = $searched;
        }
        return DataTables::of($show)->addColumn('option',function ($show){
            return '<button type="button" class="new-customer-button green-button" data-invoice="'.$show->invoice_no.'"
                    data-created_by="'.$show->created_by.'" data-date="'.$show->date.'" data-total="'.$show->grand_total.'" data-paid="'.$show->paid.'"
                    data-due="'.$show->due.'" data-toggle="modal" data-target="#view"> <i class="far fa-eye mr-1"></i>View</button>
                    <button type="button" class="new-customer-button red-button" data-id="'.$show->id.'"
                            data-toggle="modal" data-target="#delete"><i class="fas fa-trash mr-1"></i>Delete</button>
                    <form action="'.route('emi-invoice').'" method="post" target="_blank"> '.csrf_field().'
                        <input type="hidden" name="invoice_id" value="'.$show->invoice_no.'">
                        <button type="submit" style="margin-bottom:-3px;" class="new-customer-button light-blue-button mt-1">Invoice</button>
                    </form>';
        })->addColumn('pay',function ($show){
            if($show->grand_total == $show->paid) {
                 return '<button type="button" class="new-customer-button" disabled><i class="far fa-check-circle mr-1 green-button"></i>Paid</button>';
            }
            else{
                return '<button type="button" class="new-customer-button" data-id="'.$show->id.'" data-due="'.$show->due.'"
                        data-toggle="modal" data-target="#pay"><i class="far fa-edit mr-1 green-button"></i>Pay</button>';
            }
        })->setRowAttr(['align' => 'center'])->rawColumns(['option','pay'])->make(true);
    }

    public function invoice(Request $request){
        $ads1 = Advertisement::where('id',1)->first(); $id = Session::get('loggedUser')['ring'];
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        $dt = new DateTime();$date = $dt->format('d-m-Y'); $mail = ShopUser::where([['ring',$id],['type','shop']])->first(['email','shopname','mobile']);
        $expense = Expense::where([ ['shop_id', $id],['invoice_no', $request->invoice_id] ])->first();
        $expitems = ExpenseItem::where([ ['shop_id', $id],['invoice_no', $request->invoice_id] ])->get();
        $invoice_info = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','address','currency','website']);
        return view('custom_plugin.expense_invoice',compact('expense','expitems','invoice_info','date','logo','ads1','mail'));
    }

    public function paid_invoice()
    {
        $id =  Session::get('loggedUser')['ring']; $total = Expense::where('shop_id', $id)->sum('grand_total'); $pay = 'paid';
        $paid = Expense::where('shop_id', $id)->sum('paid'); $due = Expense::where('shop_id', $id)->sum('due');
        $ads1 = Advertisement::where('id',1)->first(); $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        return view('company.expense.manage_invoice',compact('logo','ads1','total','paid','due','pay'));
    }

    public function unpaid_invoice()
    {
        $id =  Session::get('loggedUser')['ring']; $total = Expense::where('shop_id', $id)->sum('grand_total'); $unpay = 'unpaid';
        $paid = Expense::where('shop_id', $id)->sum('paid'); $due = Expense::where('shop_id', $id)->sum('due');
        $ads1 = Advertisement::where('id',1)->first(); $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        return view('company.expense.manage_invoice',compact('logo','ads1','total','paid','due','unpay'));
    }

    public function expire()
    {
        $dt = new DateTime(); $dt->format('Y-m-d'); $ads1 = Advertisement::where('id',1)->first();
       // $purchase = Product::where('shop_id', Session::get('loggedUser')['ring'])->whereDate('exp_date', '<', $dt)->orderBy('exp_date', 'DESC')->sum('purchase_rate');
      //  $sell = Product::where('shop_id', Session::get('loggedUser')['ring'])->whereDate('exp_date', '<', $dt)->orderBy('exp_date', 'DESC')->sum('selling_rate');
        $qty = Product::where('shop_id', Session::get('loggedUser')['ring'])->whereDate('exp_date', '<', $dt)->orderBy('exp_date', 'DESC')->sum('qty');
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        $datas = Product::where('shop_id', Session::get('loggedUser')['ring'])->whereDate('exp_date', '<', $dt)->get(); $purchase = 0; $sell=0;
        foreach ($datas as $key => $value) {
            $data1 = array( $purchase = $purchase + $datas[$key]['purchase_rate'] * $datas[$key]['qty'] );
            $data2 = array( $sell = $sell + $datas[$key]['selling_rate'] * $datas[$key]['qty'] );
        }
        return view('company.expired.manage',compact('logo','ads1','purchase','sell','qty'));
    }

    public function expire_getData()
    {
        $dt = new DateTime(); $dt->format('Y-m-d');
        $show = Product::where('shop_id', Session::get('loggedUser')['ring'])->whereDate('exp_date', '<', $dt)->orderBy('exp_date', 'DESC')->get();
        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        if($start_date && $end_date){
            $searched = Product::whereBetween('exp_date',array($start_date,$end_date))->where('shop_id', Session::get('loggedUser')['ring'])
                ->whereDate('exp_date', '<', $dt)->orderBy('exp_date', 'DESC')->get(); $show = $searched;
        }



        return DataTables::of($show)->addColumn('expire',function ($show){ return '<span style="color: red;">'.$show->exp_date.'</span>';
               })->addColumn('option',function ($show){
            return '<button type="button" class="new-customer-button green-button mb-1" data-id="'.$show->id.'" data-name="'.$show->product_name.'" 
            data-qty="'.$show->qty.'" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i></button>
                    <button type="button" class="new-customer-button green-button mb-1" data-id="'.$show->id.'" data-name="'.$show->product_name.'" 
                    data-qty="'.$show->qty.'" data-toggle="modal" data-target="#return"><i class="fa fa-minus"></i></button>
                    <button type="button" class="new-customer-button green-button mb-1" data-id="'.$show->id.'" data-product_name="'.$show->product_name.'"
                            data-product_category="'.$show->product_category.'" data-store_in="'.$show->store_in.'" data-batch="'.$show->batch.'" 
                            data-purchase_rate="'.$show->purchase_rate.'" data-selling_rate="'.$show->selling_rate.'" data-qty="'.$show->qty.'"
                            data-generic_name="'.$show->generic_name.'" data-company="'.$show->company.'" data-effects="'.$show->effects.'" 
                            data-mfg_date="'.$show->mfg_date.'" data-exp_date="'.$show->exp_date.'" data-details="'.$show->details.'"
                            data-toggle="modal" data-target="#edit_product">Edit</button>
                    <button type="button" class="new-customer-button mb-1" data-product_name="'.$show->product_name.'" data-product_category="'.$show->product_category.'"
                            data-store_in="'.$show->store_in.'" data-batch="'.$show->batch.'" data-purchase_rate="'.$show->purchase_rate.'" data-selling_rate="'.$show->selling_rate.'" 
                            data-qty="'.$show->qty.'" data-generic_name="'.$show->generic_name.'" data-company="'.$show->company.'"
                            data-effects="'.$show->effects.'" data-mfg_date="'.$show->mfg_date.'" data-exp_date="'.$show->exp_date.'" data-details="'.$show->details.'"
                            data-toggle="modal" data-target="#view_product">View </button>
                    <button type="button" class="new-customer-button red-button mb-1" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete">Delete</button>';
        })->setRowAttr(['align' => 'center'])->rawColumns(['expire','option'])->make(true);
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
    public function invoice_store(Request $request){
        $validator = Validator::make($request->all(), [
            'item' => 'required', 'selling_rate' => 'required', 'qty' => 'required','expense_type' => 'required',
            'total' => 'required', 'grand' => 'required', 'due' => 'required',
        ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $counts = Expense::where('shop_id', Session::get('loggedUser')['ring'])->withTrashed()->count();

        $invoice = new Expense;
        $invoice->shop_id = Session::get('loggedUser')['ring'];
        $invoice->invoice_no = 222200000 + $counts; $invoice->expense_type = $request->expense_type;
        $invoice->date = $request->date; $invoice->grand_total = $request->grand; $invoice->paid = $request->paid;
        $invoice->due = $request->due; $invoice->created_by = Session::get('loggedUser')['fname'].' '.Session::get('loggedUser')['lname'];
        if ($invoice->save()) {
            $invoice = $invoice->invoice_no;
            foreach ($request->item as $key => $value) {
                $data = array(
                    'shop_id' => Session::get('loggedUser')['ring'],
                    'invoice_no' => $invoice, 'item' => $request->item[$key], 'quantity' => $request->qty[$key],
                    'selling_rate' => $request->selling_rate[$key], 'total' => $request->total[$key]
                );
                ExpenseItem::insert($data);
            }
        }
        $notification = array('message' => 'New Expense Invoice Created Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'expense_type' => 'required' ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $data = [
            'type' => $request->expense_type, 'shop_id' =>   Session::get('loggedUser')['ring'], 'created_at' => now(), 'updated_at' => now()
        ];
        ExpenseType::insert($data);
        $notification = array('message' => 'New Expense Type Added Successfully', 'alert-type' => 'success');
        return back()->with($notification);
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

public function return(Request $request)
    {
        $update = Product::find($request->id);
        if($request->add){
            $validator = Validator::make($request->all(), [ 'add' => 'required|numeric' ]);
            if ($validator->fails()) { $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
                return back()->withErrors($validator)->withInput()->with($notification);
            }
            $update->qty = $update->qty + $request->add;$update->total_qty = $update->total_qty + $request->add;
            if($update->parent_id == 0){
                $qtys = Product::where('id', $update->id)->first(['total_qty']);
                Product::where('id', $update->id)->update(['total_qty' => $qtys->total_qty + $request->add]);
            }
            else {
                $qtys = Product::where('id', $update->parent_id)->first(['total_qty']);
                Product::where('id', $update->parent_id)->update(['total_qty' => $qtys->total_qty + $request->add]);
            }
            $data = [ 'product_id' => $request->id, 'product_name' => $request->name, 'status' => 'add',
                'current_qty' => $request->quantity + $request->add, 'quantity' => $request->add, 'created_at' => now(), ];
            Statement::insert($data);
            $notification = array('message' => 'Product Added Successfully', 'alert-type' => 'success');
        }
        else if($request->return){
            $validator = Validator::make($request->all(), [ 'return' => 'required|numeric' ]);
            if ($validator->fails()) { $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
                return back()->withErrors($validator)->withInput()->with($notification);
            }
            if($request->return > $update->qty){
                $notification = array('message' => 'Error !! Can Not Return More Than Stock Quantity !', 'alert-type' => 'error');
                return back()->with($notification);
            }
            $update->qty = $update->qty - $request->return; $update->total_qty = $update->total_qty - $request->return;
            if($update->parent_id == 0) {
                $qtys = Product::where('id', $update->id)->first(['total_qty']);
                Product::where('id', $update->id)->update(['total_qty' => $qtys->total_qty - $request->return]);
            }
            else{
                $qtys = Product::where('id', $update->parent_id)->first(['total_qty']);
                Product::where('id', $update->parent_id)->update(['total_qty' => $qtys->total_qty - $request->return]);
            }
            $data = [ 'product_id' => $request->id, 'product_name' => $request->name, 'status' => 'return', 'quantity' => $request->return,
                'current_qty' => $request->quantity - $request->return, 'reason' => $request->reason, 'created_at' => now(), ];
            Statement::insert($data);
            $notification = array('message' => 'Product Returned Successfully', 'alert-type' => 'success');
        }
        $update->updated_at = now();
        $update->save();
        return back()->with($notification);
    }

    public function update(Request $request)
    {
        $update = ExpenseType::find($request->id);
        $update->type = $request->expense_type; $update->updated_at = now(); $update->save();
        $notification = array('message' => 'Expense Type Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function manage_invoice_pay(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'paid' => 'required|numeric' ]);
        if ($validator->fails()) { $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $update = Expense::find($request->id);
        if($request->paid > ($update->grand_total - $update->paid)){
            $notification = array('message' => 'Error !! Can Not Pay More Than Due Amount !', 'alert-type' => 'error');
            return back()->with($notification);
        }
        $update->paid = $update->paid + $request->paid; $update->due = $update->grand_total - $update->paid;
        $update->updated_at = now(); $update->save();
        $notification = array('message' => 'Expense Invoice Pay Information Updated Successfully', 'alert-type' => 'success');
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
        ExpenseType::where('id', $request->id)->update(['deleted_at' => now()]);
        $notification = array('message' => 'Expense Type Deleted Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function manage_invoice_destroy(Request $request)
    {
        Expense::where('id', $request->id)->update(['deleted_at' => now()]);
        $notification = array('message' => 'Expense Invoice Data Information Deleted Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }
}
