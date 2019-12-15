<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Product;
use App\ProductCategory;
use DateTime;
use App\DynamicContent;
use App\ShopContent;
use App\Advertisement;
use App\Statement;
use Session;


class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Product::where('shop_id', Session::get('loggedUser')['ring'])->get(); $purchase = 0; $sell=0; $qty=0;
        foreach ($datas as $key => $value) {
            $data1 = array( $purchase = $purchase + $datas[$key]['purchase_rate'] * $datas[$key]['qty'] );
            $data2 = array( $sell = $sell + $datas[$key]['selling_rate'] * $datas[$key]['qty'] );
            $data3 = array( $qty = $qty +  $datas[$key]['qty'] );
        }
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo','currency']);
        $categories = ProductCategory::where('shop_id',Session::get('loggedUser')['ring'])->get(['category']);
        $units = DynamicContent::where('section','unit')->get(); $ads1 = Advertisement::where('id',1)->first();
        return view('company.stock.manage',compact('logo','categories','units','ads1','purchase','sell','qty'));
    }

    public function getData()
    {
        $id = Session::get('loggedUser')['ring'];
        $show = Product::where([['parent_id','=',0],['shop_id',$id]])->orderBy('created_at','DESC')->get();

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        if($start_date && $end_date){
            $searched = Product::whereBetween('exp_date',array($start_date,$end_date))->where([['parent_id','=',0],['shop_id',$id]])
                ->orderBy('created_at','DESC')->get();
            $show = $searched;
        }



        return DataTables::of($show)->addColumn('subproduct',function ($show){
            return '<button type="buuton" class="new-customer-button green-button mb-1" data-toggle="modal" data-target="#subproduct"
                         data-parent_id="'.$show->id.'" data-unit="'.$show->unit.'" data-name="'.$show->product_name.'"
                         data-category="'.$show->product_category.'"> <i class="fa fa-store"></i> Add </button>
                        <a href="'.url('/stock/subproduct/'.$show->barcode).'" target="_blank" class="btn btn-info btn-sm">
                        <i class="fa fa-eye"></i> View </a>';
        })->addColumn('option',function ($show){
            return '<div class="row"><div class="col-md-2 mr-1">
                            <button type="button" class="new-customer-button green-button mb-1" data-id="'.$show->id.'" data-name="'.$show->product_name.'" 
                            data-qty="'.$show->qty.'" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i></button></div>
                                <div class="col-md-2 mr-1">
                            <button type="button" class="new-customer-button green-button mb-1" data-id="'.$show->id.'" data-name="'.$show->product_name.'" 
                            data-qty="'.$show->qty.'" data-toggle="modal" data-target="#return"> <i class="fa fa-minus"></i></button></div>
                            <div class="col-md-2 mr-1">
                            <button type="button" class="new-customer-button mb-1" data-product_name="'.$show->product_name.'" 
                                data-product_category="'.$show->product_category.'" data-store_in="'.$show->store_in.'" data-batch="'.$show->batch.'"
                                    data-purchase_rate="'.$show->purchase_rate.'" data-selling_rate="'.$show->selling_rate.'" data-qty="'.$show->qty.'" data-company="'.$show->company.'"
                                    data-mfg_date="'.$show->mfg_date.'" data-exp_date="'.$show->exp_date.'" data-details="'.$show->details.'" 
                                    data-toggle="modal" data-target="#view_product"><i class="fa fa-eye"></i></button>
                                </div><div class="col-md-2 mr-1">
                            <button type="button" class="new-customer-button green-button mb-1" data-id="'.$show->id.'" data-product_name="'.$show->product_name.'" 
                                    data-product_category="'.$show->product_category.'" data-store_in="'.$show->store_in.'" data-batch="'.$show->batch.'"
                                    data-purchase_rate="'.$show->purchase_rate.'" data-selling_rate="'.$show->selling_rate.'" data-qty="'.$show->qty.'" 
                                    data-company="'.$show->company.'" data-mfg_date="'.$show->mfg_date.'" data-exp_date="'.$show->exp_date.'" 
                                    data-details="'.$show->details.'" data-toggle="modal" data-target="#edit_product"><i class="fa fa-edit"></i>
                            </button></div></div>
                            <div class="row">
                                <div class="col-md-3 mr-3">
                                    <form method="post" action="'.route('statement').'" target="_blank">'.csrf_field().'
                                        <input type="hidden" name="id" value="'.$show->id.'" />
                                        <input type="hidden" name="name" value="'.$show->product_name.'" />
                                        <button type="submit" class="new-customer-button light-blue-button mb-1">Statement</button>
                                    </form></div>
                                <div class="col-md-3">
                                    <button type="button" class="new-customer-button red-button ml-2" data-id="'.$show->id.'"
                                            data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i>
                                    </button>
                                </div></div>';
        })->setRowAttr(['align' => 'center'])->rawColumns(['subproduct','option'])->make(true);
    }

    public function stock_alert()
    {
        $ads1 = Advertisement::where('id',1)->first(); $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.stock.alert',compact('shows','logo','ads1'));
    }

    public function alertGetData()
    {
        $id = Session::get('loggedUser')['ring']; $show = Product::where([ ['shop_id', $id],['qty', '<', 21] ])->get();
        return DataTables::of($show)->addColumn('option',function ($show){
            return '<button type="button" class="new-customer-button green-button mb-1" data-id="'.$show->id.'" data-name="'.$show->product_name.'" 
                        data-qty="'.$show->qty.'" data-toggle="modal" data-target="#return"> <i class="fa fa-minus"></i></button>
                        <button type="button" class="new-customer-button green-button mb-1" data-id="'.$show->id.'" data-product_name="'.$show->product_name.'" 
                                data-product_category="'.$show->product_category.'" data-store_in="'.$show->store_in.'" data-batch="'.$show->batch.'"
                                data-purchase_rate="'.$show->purchase_rate.'" data-selling_rate="'.$show->selling_rate.'" data-qty="'.$show->qty.'" 
                                data-generic_name="'.$show->generic_name.'" data-company="'.$show->company.'" data-effects="'.$show->effects.'"
                                data-mfg_date="'.$show->mfg_date.'" data-exp_date="'.$show->exp_date.'" data-details="'.$show->details.'"
                                data-toggle="modal" data-target="#edit_product"><i class="fa fa-edit"></i></button>
                        <button type="button" class="new-customer-button mb-1" data-product_name="'.$show->product_name.'"
                                data-product_category="'.$show->product_category.'" data-store_in="'.$show->store_in.'" data-batch="'.$show->batch.'"
                                data-purchase_rate="'.$show->purchase_rate.'" data-selling_rate="'.$show->selling_rate.'" data-qty="'.$show->qty.'"
                                data-generic_name="'.$show->generic_name.'" data-company="'.$show->company.'" data-effects="'.$show->effects.'"
                                data-mfg_date="'.$show->mfg_date.'" data-exp_date="'.$show->exp_date.'" data-details="'.$show->details.'" 
                                data-toggle="modal" data-target="#view_product"><i class="fa fa-eye"></i></button>
                        <button type="button" class="new-customer-button red-button mb-1" data-id="'.$show->id.'" data-toggle="modal" 
                                data-target="#delete"><i class="fa fa-trash"></i></button>
                        <form method="post" action="'.route('statement').'" target="_blank">'.csrf_field().'
                            <input type="hidden" name="id" value="'.$show->id.'" /> <input type="hidden" name="name" value="'.$show->product_name.'" />
                            <button type="submit" class="new-customer-button light-blue-button mb-1">Statement</button>
                        </form>';
        })->setRowAttr(['align' => 'center'])->rawColumns(['option'])->make(true);
    }

    public function subProduct($barcode){
        $data = Product::where('barcode', $barcode)->first();
        $shows = Product::where('parent_id', $data->id)->get();
        $ads1 = Advertisement::where('id',1)->first(); $name = $data->product_name;
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.stock.subproduct',compact('shows','logo','ads1','name'));
    }

    public function statement(Request $request){
        $ads1 = Advertisement::where('id',1)->first();
        $product_id = $request->id; $name = $request->name;
        $logo = ShopContent::where('shop_id',Session::get('loggedUser')['ring'])->first(['logo']);
        return view('company.stock.statement',compact('product_id','name','logo','ads1'));
    }

    public function statementGetData()
    {
        $pro_id = (!empty($_GET["product_id"])) ? ($_GET["product_id"]) : ('');
        if($pro_id){ $show =  Statement::where('product_id', $pro_id)->get(); }
        return DataTables::of($show)->addColumn('qty',function ($show){
            if($show->status == 'add') { return '.<span style="color: green;font-weight: bold">' . $show->quantity . '</span>'; }
            else { return '.<span style="color: red;font-weight: bold">' . $show->quantity . '</span>'; }
        })->addColumn('date',function ($show){ return $show->created_at->format('d/m/Y');
        })->setRowAttr(['align' => 'center'])->rawColumns(['qty','date'])->make(true);
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
