@extends('layout.company.masterpage')
@section('title', 'Invoice')
@section('masterpage')
<style> @media print {  .example-print { overflow: hidden; }  }</style>
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Invoice</h2>
                        <a href="#">Dashboard</a><a href="#">Invoice</a>
                    </div>
                </div>
                @if($ads1->status == 'on')
                <div class="col-md-8" id="Ads">
                    {!! html_entity_decode($ads1->code)!!}
                </div>
                <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                @endif
            </div>
            <div class="row new-sales-table-bg">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-7"></div>
                        <div class="col-lg-5">
                            <div class="product-category-search">
                                <button class="btn btn-info" onclick="printForm('printableArea')"><i class="fa fa-print"></i> Invoice Print</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="printableArea">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h1 style="font-size: 70px;"> 
                                        INVOICE </h1>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="{{asset('public/shop_logo/'.$invoice_info->logo)}}" height="140px;" width="140px;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <h5> INVOICE NUMBER  {{$sale->sales_no}}</h5>
                                        <h5> DATE OF ISSUE  {{$date}} </h5><br><br>
                                        <h5> BILLED TO </h5>
                                        <h5> {{$sale->cus_name}} </h5>
                                        <h5> {{$sale->cus_mobile}} </h5>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 100px;">
                                        <h3>{{$mail->shopname}} </h3>
                                        <h5>{{$invoice_info->address}}</h5>
                                        <h5>{{$mail->mobile}}</h5>
                                        <h5>{{$mail->email}}</h5>
                                        <h5>{{$invoice_info->website}}</h5>
                                    </div>
                                </div>

                                <br>
                                <br>
                                <br><br>
                                <table width="100%;">
                                    <thead>
                                    <tr style="border-bottom: 4px solid #000;">
                                        <th style="width:35%"><h5>ITEM</h5></th>
                                        <th style="width:15%"><h5>CATEGORY</h5></th>
                                        <th style="width:10%"><h5>UNIT COST</h5></th>
                                        <th style="width:10%"><h5>QUANTITY</h5></th>
                                        <th style="width:10%"><h5>DISCOUNT</h5></th>
                                        <th style="width:10%"><h5>AMOUNT</h5></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $disC = 0; ?>
                                    @foreach($saleitems as $saleitem)
                                    <tr style=" border-bottom: 2px solid #000;">
                                        <td style=" padding: 6px 1px;"><h5>{{$saleitem->item}} &nbsp;{{$saleitem->return_data}}</h5></td>
                                        <td style=" padding: 6px 1px;"><h5>{{$saleitem->category}}</h5></td>
                                        <td style=" padding: 6px 1px;"><h5>{{$saleitem->sale_rate}}</h5></td>
                                        <td style=" padding: 6px 1px;"><h5>{{$saleitem->qty}}</h5></td>
                                        <td style=" padding: 6px 1px;"><h5>{{$saleitem->discount_cost}}</h5></td>
                                        <td style=" padding: 6px 1px;"><h5>{{$saleitem->total}}</h5></td>
                                    </tr>
                                   <?php $disC = $disC + $saleitem->discount_cost; ?>
                                    @endforeach
                                    </tbody>
                                </table>

                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5> INVOICE TOTAL </h5>
                                        <h1 style="color: #1a4993;"> {{$invoice_info->currency}} {{$sale->grand_total}} </h1>
                                    </div>
                                    <div class="col-md-9">

                                <table style="width:100%;">
                                    <tr>
                                        <th style="width:30%"></th><th style="width:10%"></th>
                                        <th style="width:15%"></th><th style="width:26%;"></th><th style="width:14%"></th>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td><td><h5>SUB TOTAL</h5></td><td><h5>{{$sale->sub_total}}</h5></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td><td><h5>GRAND TOTAL</h5></td><td><h5>{{$sale->grand_total}}</h5></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td><td><h5>TOTAL DISCOUNT</h5></td><td><h5><?php echo number_format($disC,2);?></h5></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td><td><h5>TAX/VAT</h5></td><td><h5>{{$sale->vat_cost}}</h5></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td><td><h5>SERVICE CHARGE</h5></td><td><h5>{{$sale->service_cost}}</h5></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td><td><h5>PAID AMOUNT</h5></td><td><h5>{{$sale->paid}}</h5></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td><td><h5>DUE AMOUNT</h5></td><td><h5>{{$sale->remaining}}</h5></td>
                                    </tr>
                                </table>

                                    </div>
                                </div>

                                <br><br><br><br>
                                <h5> INVOICE CREATED BY: {{Session::get('loggedUser')['fname']}} {{Session::get('loggedUser')['lname']}}</h5>
                                <h5>DATE: {{$date}}</h5><br>

<!--                                <footer style="position: absolute;bottom: 0;text-align:right;width: 100%;height: 2.5rem;"> <h5>Powered By sozashop.com </h5></footer>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('custom_plugin.js_files')
<script>
    function printForm(divName) {
        var printContents = document.getElementById(divName).innerHTML;var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents; window.print(); document.body.innerHTML = originalContents;
    }
</script>
@endsection
