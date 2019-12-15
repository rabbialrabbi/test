<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Sale;
use App\SaleItem;
use App\ShopContent;
use App\Expense;
use App\Advertisement;
use Session;
class ReportController extends Controller
{

    public function index()
    {
        $id =  Session::get('loggedUser')['ring'];
        $purchases = SaleItem::where('shop_id',$id)->get(['purchase_cost','qty']); $purchase = 0;
        foreach ($purchases as $key => $value) {
            $prchse = array( $purchase = $purchase +  ($purchases[$key]['purchase_cost'] * $purchases[$key]['qty']));
        }
        $sales = SaleItem::where('shop_id',$id)->get(['sale_rate','qty']); $sale = 0;
        foreach ($sales as $key => $value) {
            $sle = array( $sale = $sale +  ($sales[$key]['sale_rate'] * $sales[$key]['qty']));
        }
        $qty = SaleItem::where('shop_id',$id)->sum('qty');
        $discount = SaleItem::where('shop_id',$id)->sum('discount_cost');
        $total = SaleItem::where('shop_id',$id)->sum('total');
        $data = SaleItem::where('shop_id',$id)->get(['qty','purchase_cost','total']); $profit = 0;
        foreach ($data as $key => $value) {
            $datas = array( $profit = $profit + ($data[$key]['total'] - ($data[$key]['purchase_cost'] * $data[$key]['qty'] )));
        }
        $ads1 = Advertisement::where('id',1)->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.report.ledger',compact('logo','ads1','purchase','qty','sale','discount','total','profit'));
    }
    public function ledger_getData()
    {
        $show = SaleItem::where('shop_id', Session::get('loggedUser')['ring'])->orderBy('sales_no','DESC')->get();

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        if($start_date && $end_date){
            $searched = SaleItem::whereBetween('created_at',array($start_date,$end_date))->where('shop_id', Session::get('loggedUser')['ring'])
                ->orderBy('sales_no','DESC')->get(); $show = $searched;
        }
         return DataTables::of($show)->addColumn('profit',function ($show){
            return round($show->total - ($show->purchase_cost * $show->qty),2); })
            ->addColumn('date',function ($show){ return $show->created_at->format('d/m/Y'); })
            ->addColumn('total_purchase',function ($show){ return $show->purchase_cost * $show->qty; })->rawColumns(['date','profit','total_purchase'])
            ->setRowAttr(['align' => 'center'])->make(true);
    }

    public function salesLedger()
    {
        $id =  Session::get('loggedUser')['ring'];$total = Sale::where('shop_id',$id)->sum('grand_total');
        $paid = Sale::where('shop_id',$id)->sum('paid'); $due = Sale::where('shop_id',$id)->sum('remaining');
        $vat = Sale::where('shop_id',$id)->sum('vat_cost');  $service = Sale::where('shop_id',$id)->sum('service_cost');
        $ads1 = Advertisement::where('id',1)->first();
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','vat_type','service_type']);
        return view('company.report.sales',compact('logo','ads1','total','paid','due','vat','service'));
    }

    public function sales_getData()
    {
        $show = Sale::where('shop_id', Session::get('loggedUser')['ring'])->orderBy('sales_no','DESC')->get();

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        if($start_date && $end_date){
            $start_date = date('d/m/Y', strtotime($start_date));$end_date = date('d/m/Y', strtotime($end_date));
            $searched = Sale::whereBetween('date',array($start_date,$end_date))->where('shop_id', Session::get('loggedUser')['ring'])
                ->orderBy('sales_no','DESC')->get(); $show = $searched;
        }
        return DataTables::of($show)->setRowAttr(['align' => 'center'])->make(true);
    }

    public function expenseLedger()
    {
        $ads1 = Advertisement::where('id',1)->first();
        $id =  Session::get('loggedUser')['ring'];$total = Expense::where('shop_id',$id)->sum('grand_total');
        $paid = Expense::where('shop_id',$id)->sum('paid'); $due = Expense::where('shop_id',$id)->sum('due');
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.report.expense',compact('logo','ads1','total','paid','due'));
    }

    public function expense_getData()
    {
        $show = Expense::where('shop_id', Session::get('loggedUser')['ring'])->orderBy('invoice_no','DESC')->get();

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        if($start_date && $end_date){
            $searched = Expense::whereBetween('date',array($start_date,$end_date))->where('shop_id', Session::get('loggedUser')['ring'])
                ->orderBy('invoice_no','DESC')->get(); $show = $searched;
        }


        return DataTables::of($show)->setRowAttr(['align' => 'center'])->make(true);
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
    public function update(Request $request, $id)
    {
        //
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
}
