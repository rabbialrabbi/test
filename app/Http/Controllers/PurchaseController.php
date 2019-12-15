<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Product;
use App\Sale;
use App\SaleItem;
use App\ShopContent;
use App\ShopUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Yajra\DataTables\DataTables;

class PurchaseController extends Controller
{

    public function index()
    {
        return redirect()->route('product');
    }

    public function create()
    {
        //
    }
    // Print Invoice
    public function printInvoice($id)
    {
        $purchase_info              = DB::table('purchases')->where('id',$id)->first();
        $purchase_payment_details   = DB::table('purchase_payment_details')->where('purchase_id',$id)->get();
        dd($purchase_info);
    }
    // Manage purchase
    public function manage_purchase(){
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        $ads1 = Advertisement::where('id',1)->first(); $id = Session::get('loggedUser')['ring'];
        $mail = ShopUser::where([['ring',$id],['type','shop']])->first(['email','shopname','mobile']);
        $invoice_info = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','address','currency','website']);
        return view('company.purchase.manage',compact('ads1','logo','invoice_info','ads1','mail'));
    }
    public function getPurchaseData()
    {
       $id = Session::get('loggedUser')['ring'];
        $show = DB::table('purchases')
            ->join('products', function ($join) use($id) {

                $join->on('purchases.product_id', '=', 'products.id')->where('purchases.shop_id',$id);
            })
            ->join('companies',function($join){
                $join->on('purchases.supplier_id', '=', 'companies.id');
            })
            ->get();
        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        if($start_date && $end_date){
            $searched = DB::table('purchases')->whereBetween('exp_date',array($start_date,$end_date))->where([['shop_id', $id],['parent_id',0]])
                ->orderBy('created_at','DESC')->get(); $show = $searched;
        }

        return DataTables::of($show)->addColumn('option',function ($show){
            return '<button type="button" class="new-customer-button mb-1" data-productName="'.$show->product_id.'" data-supplier="'.$show->supplier_id.'"
                        data-purchaseBy="'.$show->purchase_by.'" data-payment="'.$show->payment.'" data-purchase_rate="'.$show->purchase_rate.'"
                        data-selling_rate="'.$show->selling_rate.'" data-qty="'.$show->qty.'" data-total="'.$show->total_amount.'" data-toggle="modal" data-target="#view_purchase_invoice"><i class="fa fa-eye"></i> Invoice</button>
                        <a href="'.route('purchase-invoice-print',$show->id).'">Invoice</a>
                     <button  type="button" class="new-customer-button green-button mb-1" data-toggle="modal" data-target="#edit_product"><i class="fa fa-edit"></i> Edit</button>
                     <button type="button" class="new-customer-button red-button mb-1" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete"> Delete </button>
                     <form action="'.route('product-barcode').'" method="post" target="_blank"> '.csrf_field().'
                        <input type="hidden" name="id" value="'.$show->id.'">
                        <button type="submit" style="margin-bottom:-3px;" class="new-customer-button mb-1">
                            <i class="fa fa-barcode"></i></button></form>';
        })->addColumn('quantity',function ($show){ return '<span style="color: green;font-weight: bold;">'.$show->qty.'</span>';
        })->setRowAttr(['align' => 'center'])->rawColumns(['quantity','option'])->make(true);
    }
    public function paid()
    {
        $ads1 = Advertisement::where('id',1)->first();$id = Session::get('loggedUser')['ring'];
        $total = DB::table('purchases')->where([['shop_id', $id],['status','Paid']])->sum('total_amount');
        $paid = DB::table('purchases')->where([['shop_id', $id],['status','Paid']])->sum('payment');
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        return view('company.purchase.paid',compact('logo','ads1','total','paid'));
    }

    public function paid_getData()
    {
        $show = DB::table('purchases')->where('shop_id', Session::get('loggedUser')['ring'])->where('status', 'Paid')->get();
        return DataTables::of($show)->addColumn('option',function ($show){
            return '<button type="button" class="new-customer-button green-button" data-cus_name="'.$show->cus_name.'" data-seller="'.$show->seller.'"
                        data-date="'.$show->date.'" data-grand_total="'.$show->grand_total.'" data-total_discount="'.$show->total_discount.'"
                        data-paid="'.$show->paid.'" data-toggle="modal" data-target="#sl-view">View </button>
                <button type="button" class="new-customer-button red-button" data-id="'.$show->id.'" data-toggle="modal" data-target="#delete">
                    <i class="far fa-trash-alt margin-right-css"></i>Delete </button>';
        })->setRowAttr(['align' => 'center'])->rawColumns(['option'])->make(true);
    }
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {

    }
    // Invoice Print
    public function viewInvoice(Request $request)
    {
        $id = $request->invoice_id;

        $purchase_info = DB::table('purchases')->where('id',$id)->first();
        $payment_info = DB::table('purchase_payment_details')->where('purchase_id',$id)->get();
        dd($purchase_info);
        //dd($purchase_info);
        $ads1 = Advertisement::where('id',1)->first(); $id = Session::get('loggedUser')['ring'];
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        $mail = ShopUser::where([['ring',$id],['type','shop']])->first(['email','shopname','mobile']);
        $invoice_info = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','address','currency','website']);
        return view('company.purchase.invoice',compact('invoice_info','logo','ads1','mail'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
