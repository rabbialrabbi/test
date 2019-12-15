@extends('layout.company.masterpage')
@section('title', 'Expense Invoice')
@section('masterpage')
<style> @media print {  .example-print { overflow: hidden; }  } </style>
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Expense Invoice</h2>
                        <a href="#">Dashboard</a><a href="#">Expense Invoice</a>
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
                        <div class="col-md-7"></div>
                        <div class="col-lg-5">
                            <div class="product-category-search">
                                <button class="btn btn-info" onclick="printForm('printableArea')"><i class="fa fa-print"></i> Invoice Print</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="printableArea">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h1 style="font-size: 70px;">EXPENSE INVOICE </h1>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="{{asset('public/shop_logo/'.$invoice_info->logo)}}" height="140px;" width="140px;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <h5> INVOICE NUMBER  {{$expense->invoice_no}}</h5>
                                        <h5> DATE OF ISSUE  {{$date}} </h5>
                                        <h5> EXPENSE TYPE:  {{$expense->expense_type}} </h5><br><br>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 100px;">
                                        <h3>{{$mail->shopname}}</h3>
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
                                        <th style="width:70%"><h5>ITEM</h5></th>
                                        <th style="width:10%"><h5>UNIT COST</h5></th>
                                        <th style="width:10%"><h5>QUANTITY</h5></th>
                                        <th style="width:10%"><h5>AMOUNT</h5></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($expitems as $key => $expitem)
                                    <tr style=" border-bottom: 2px solid #000;">
                                        <td>{{$expitem->item}}</td>
                                        <td>{{$expitem->selling_rate}}</td>
                                        <td>{{$expitem->quantity}}</td>
                                        <td>{{$expitem->total}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5> INVOICE TOTAL </h5>
                                        <h1 style="color: #1a4993;"> {{$invoice_info->currency}} {{$expense->grand_total}} </h1>
                                    </div>
                                    <div class="col-md-9">

                                        <table style="width:100%;">
                                            <tr>
                                                <th style="width:30%"></th><th style="width:10%"></th>
                                                <th style="width:15%"></th><th style="width:26%;"></th><th style="width:14%"></th>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td><td><h5>GRAND TOTAL</h5></td><td><h5>{{$expense->grand_total}}</h5></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td><td><h5>PAID AMOUNT</h5></td><td><h5>{{$expense->paid}}</h5></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td><td><h5>DUE AMOUNT</h5></td><td><h5>{{$expense->due}}</h5></td>
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
