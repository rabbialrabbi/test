<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DateTime;
use App\Loan;
use App\ShopUser;
use App\StatementPay;
use App\ShopContent;
use App\Advertisement;
use Yajra\DataTables\DataTables;
use Session;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads1 = Advertisement::where('id',1)->first();$ads2 = Advertisement::where('id',2)->first();
        $loaners = Loan::where('shop_id', Session::get('loggedUser')['ring'])->get(['id', 'loaner']);
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.loan.add',compact('loaners','logo','ads1','ads2'));
    }

    public function manage()
    {
        $id =  Session::get('loggedUser')['ring'];$total = Loan::where('shop_id',$id)->sum('total_amount');
        $paid = Loan::where('shop_id',$id)->sum('returned'); $due = Loan::where('shop_id',$id)->sum('remaining');
        $ads1 = Advertisement::where('id',1)->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        return view('company.loan.manage',compact('logo','ads1','total','paid','due'));
    }

    public function loan_getData()
    {
        $id = Session::get('loggedUser')['ring'];
        $show = Loan::where([ ['shop_id', $id],['type', '!=', null] ])->orderBy('created_at','DESC')->get();
        return DataTables::of($show)->addColumn('option',function ($show){
            return '<div class="row"><div class="col-md-4 mb-1"><form action="'.route('loan-invoice').'" method="post" target="_blank"> 
                         '.csrf_field().'<input type="hidden" name="invoice_id" value="'.$show->id.'">
                            <button type="submit" style="margin-bottom:-3px;" class="new-customer-button light-blue-button">Invoice</button>
                        </form>
                       </div><div class="col-md-3">
                            <button type="button" class="sales-button light-blue-button mb-1" data-id="'.$show->id.'" data-due="'.$show->remaining.'"
                            data-toggle="modal" data-target="#pay">Pay</button>
                            </div>
                            <div class="col-md-3 mr-2">
                            <button type="button" class="sales-button green-button mb-1" data-loaner="'.$show->loaner.'" data-mobile="'.$show->mobile.'"
                            data-contract_start="'.$show->contract_start.'" data-loan="'.$show->loan.'" data-returned="'.$show->returned.'" 
                            data-contract_end="'.$show->contract_end.'" data-interest="'.$show->interest.'" data-total_amount="'.$show->total_amount.'"
                            data-remaining="'.$show->remaining.'" data-type="'.$show->type.'" data-toggle="modal" data-target="#loan-view">
                             View</button>
                            </div>
                       </div>
                       
                    <button type="button" class="new-customer-button" data-id="'.$show->id.'" data-loaner="'.$show->loaner.'" data-mobile="'.$show->mobile.'"
                            data-contract_start="'.$show->contract_start.'" data-loan="'.$show->loan.'" data-contract_end="'.$show->contract_end.'"
                            data-interest="'.$show->interest.'" data-type="'.$show->type.'" data-toggle="modal" data-target="#loan-edit">
                            <i class="far fa-edit margin-right-css"></i> Edit </button>
                    <button type="button" class="new-customer-button red-button" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete">
                        <i class="far fa-trash-alt margin-right-css"></i>Delete </button>';
        })->setRowAttr(['align' => 'center'])->rawColumns(['option'])->make(true);
    }
    
     public function invoice(Request $request){
        $ads1 = Advertisement::where('id',1)->first(); $id = Session::get('loggedUser')['ring'];
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        $dt = new DateTime();$date = $dt->format('d-m-Y'); $mail = ShopUser::where([['ring',$id],['type','shop']])->first(['email','shopname','mobile']);
        $loan = Loan::where([ ['shop_id', $id],['id', $request->invoice_id] ])->first();
        $pay_info = StatementPay::where([ ['shop_id', $id],['loan_id', $request->invoice_id] ])->get();
        $invoice_info = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','address','currency','website']);
        return view('custom_plugin.loan_invoice',compact('loan','pay_info','invoice_info','date','logo','ads1','mail'));
    }
    public function loaner()
    {
        $ads1 = Advertisement::where('id',1)->first(); $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.loan.loaner',compact('logo','ads1'));
    }

    public function loaner_getData()
    {
        $show = Loan::where('shop_id', Session::get('loggedUser')['ring'])->get(['id','loaner','mobile','email','address','created_at']);
        return DataTables::of($show)->addColumn('option',function ($show){
            return '<button type="button" class="new-customer-button green-button" data-loaner="'.$show->loaner.'" data-mobile="'.$show->mobile.'"
                            data-email="'.$show->email.'" data-address="'.$show->address.'" data-toggle="modal" data-target="#l-view">
                        <i class="far fa-edit margin-right-css"></i>View </button>
                    <button type="button" class="new-customer-button" data-id="'.$show->id.'" data-loaner="'.$show->loaner.'" data-mobile="'.$show->mobile.'"
                            data-email="'.$show->email.'" data-address="'.$show->address.'" data-toggle="modal" data-target="#l-edit"><i
                            class="far fa-edit margin-right-css"></i>Edit </button>
                    <button type="button" class="new-customer-button red-button" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete"><i
                            class="far fa-trash-alt margin-right-css"></i>Delete</button>';
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

    public function loaner_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loaner' => 'required', 'mobile' => 'required',
        ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $data = [
            'shop_id' => Session::get('loggedUser')['ring'], 'loaner' => $request->loaner, 'mobile' => $request->mobile, 'email' => $request->email,
            'address' => $request->address, 'created_at' => now(), 'updated_at' => now()
        ];
        Loan::insert($data);
        $notification = array('message' => 'New Loaner Added Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loaner_id' => 'required', 'type' => 'required', 'num1' => 'required|numeric', 'num2' => 'required|numeric', 'contract_start' => 'required',
            'contract_end' => 'required', 'sum' => 'required',
        ]);
        if ($validator->fails()) {
            $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $update = Loan::find($request->loaner_id);
        $update->type = $request->type; $update->loan = $request->num1; $update->interest = $request->num2;
        $update->contract_start = $request->contract_start; $update->contract_end = $request->contract_end;
        $update->total_amount = $request->sum; $update->remaining = $request->sum; $update->detail = $request->detail;
        $update->updated_at = now(); $update->save();
        $notification = array('message' => 'New Loan Information Added Successfully', 'alert-type' => 'success');
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
    public function loaner_update(Request $request)
    {
        $update = Loan::find($request->id);
        $update->loaner = $request->loaner; $update->mobile = $request->mobile; $update->email = $request->email;
        $update->address = $request->address; $update->updated_at = now(); $update->save();
        $notification = array('message' => 'Loaner Information Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function pay(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'returned' => 'required|numeric' ]);
        if ($validator->fails()) { $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        $update = Loan::find($request->id);
        if($request->returned > ($update->total_amount - $update->returned)){
            $notification = array('message' => 'Error !! Can Not Pay More Than Due Amount !', 'alert-type' => 'error');
            return back()->with($notification);
        }
        $update->returned = $update->returned + $request->returned; $update->remaining = $update->total_amount - $update->returned;
        $update->updated_at = now(); $update->save();

        $data2 = [ 'shop_id' => Session::get('loggedUser')['ring'], 'loan_id' => $update->id, 'amount' => $request->returned,
            'date' => date('d/m/Y'), 'created_at' => now() ];
        StatementPay::insert($data2);

        $notification = array('message' => 'Loaner Information Updated Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'loan' => 'required|numeric', 'interest' => 'required|numeric']);
        if ($validator->fails()) { $notification = array('message' => 'Error !! Insert Data Again !', 'alert-type' => 'error');
            return back()->withErrors($validator)->withInput()->with($notification);
        }
        
        $datetime1 = new DateTime($request->contract_start); $datetime2 = new DateTime($request->contract_end);
        $interval = $datetime1->diff($datetime2); $diff_days = $interval->format('%a');

        $update = Loan::find($request->id);
        $update->loaner = $request->loaner;$update->mobile = $request->mobile; $update->contract_start = $request->contract_start;
        $update->contract_end = $request->contract_end; $update->loan = $request->loan; $update->interest = $request->interest;
        $total = $request->loan + (((($request->loan * $request->interest)/100)/365) * $diff_days);
        $update->total_amount = number_format($total, 2, '.', '');
        $update->remaining =  $update->total_amount -  $update->returned; $update->type = $request->type;
        $update->updated_at = now(); $update->save();
        $notification = array('message' => 'Loaner Information Updated Successfully', 'alert-type' => 'success');
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
        Loan::where('id', $request->id)->update(['deleted_at' => now()]);
        $notification = array('message' => 'Loaner Information Deleted Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }
}
