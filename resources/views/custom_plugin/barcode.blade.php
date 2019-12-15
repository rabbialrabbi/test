@extends('layout.company.masterpage')
@section('title', 'Product Barcode')
@section('masterpage')
<style> @media print {  .example-print { overflow: hidden; }  } </style>
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Product Barcode</h2>
                        <a href="#">Dashboard</a><a href="#">Product Barcode</a>
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
                        <div class="col-md-7"><h2>Barcode Print</h2></div>
                        <div class="col-lg-5">
                            <div class="product-category-search">
                                <button class="btn btn-info" onclick="printForm('printableArea')"><i class="fa fa-barcode"></i> Barcode Print</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="printableArea">
                                <div class="row mb-2 mt-2">
                                    <div class="col-md-3">
                                        <h1 style="font-size: 25px;"> Product Name: {{$barcode_info->product_name}} </h1>
                                    </div>
                                    <div class="col-md-3">
                                        <h1 style="font-size: 25px;"> Price: {{number_format($barcode_info->selling_rate,'2')}} </h1>
                                    </div>
                                    <div class="col-md-3">
                                        <h1 style="font-size: 25px;"> Barcode No: {{$barcode_info->barcode}} </h1>
                                    </div>
                                    <div class="col-md-3">
                                        <h1 style="font-size: 25px;"> Date: {{$date}} </h1>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered star-stuff-product-barCode">
                                            <tbody>
                                            @for($i=1;$i<5;$i++)
                                            <tr>

                                                <td style="text-align: center;color: black;">{{$barcode_info->product_name}}<br>
                                                    <?php echo '<img src="data:image/png;base64,'.DNS1D::getBarcodePNG($barcode_info->barcode, "C128B").'"
                                                    width="200px;" alt="barcode" />' ?> <br>{{$barcode_info->barcode}} <br>
                                                    price: {{$logo->currency}} {{number_format($barcode_info->selling_rate,'2')}}<br>
                                                </td>
                                                <td style="text-align: center;color: black;">{{$barcode_info->product_name}}<br>
                                                    <?php echo '<img src="data:image/png;base64,'.DNS1D::getBarcodePNG($barcode_info->barcode, "C128B").'"
                                                    width="200px;" alt="barcode" />' ?> <br>
                                                    {{$barcode_info->barcode}} <br>
                                                    price: {{$logo->currency}} {{number_format($barcode_info->selling_rate,'2')}}<br></td>
                                                <td style="text-align: center;color: black;">{{$barcode_info->product_name}}<br>
                                                    <?php echo '<img src="data:image/png;base64,'.DNS1D::getBarcodePNG($barcode_info->barcode, "C128B").'"
                                                    width="200px;" alt="barcode" />' ?> <br>{{$barcode_info->barcode}} <br>
                                                    price: {{$logo->currency}} {{number_format($barcode_info->selling_rate,'2')}}<br></td>
                                                <td style="text-align: center;color: black;">{{$barcode_info->product_name}}<br>
                                                    <?php echo '<img src="data:image/png;base64,'.DNS1D::getBarcodePNG($barcode_info->barcode, "C128B").'"
                                                    width="200px;" alt="barcode" />' ?> <br>{{$barcode_info->barcode}} <br>
                                                    price: {{$logo->currency}} {{number_format($barcode_info->selling_rate,'2')}}<br></td>
                                            </tr>
                                            @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br><br><br><br>
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
