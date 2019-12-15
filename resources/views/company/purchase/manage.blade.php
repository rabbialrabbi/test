@extends('layout.company.masterpage')
@section('title', 'Manage Purchase')
@section('masterpage')
@if(in_array('product', explode(",", Session::get('loggedUser')['role']  )))
<style>
    @media print {
        .non-printable { display: none; }
        #printable { display: block; }
        .modal-header, .modal-footer { display: none; }
        .modal-content { border-color: white; }
        .dashboard-header, .dashboard-left-side-menu, .dashboard-right-content, .footer,
        #non-printable { display: none !important; }
        #printable { display: block; }
    }
    .modal-dialog {
        max-width: 60%;
        margin: 1.75rem auto;
    }
</style>
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Manage Purchase</h2> <a href="#">Dashboard</a> <a href="#">Manage Purchase</a>
                    </div>
                </div>
                @if($ads1->tableAds == 'on')  <div id="TableAds" style="display: none"> Table Ads </div> @endif
                @if($ads1->status == 'on')
                <div class="col-md-8" id="Ads">
                    {!! html_entity_decode($ads1->code)!!}
                </div>
                <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                @endif
            </div>
            <div class="row new-sales-table-bg">
                <div class="col-md-12">
                    <div class="row mb-2">
                        <div class="col-md-5"> <h2>Exporting Product Data</h2> </div>
                        <div class="col-lg-7">
                            <div class="product-category-search">
                                    <label>From</label>
                                    <input class="input-search-product" name="froms" id="froms" type="date">
                                    <label>To</label>
                                    <input class="input-search-product" name="tos" id="tos" type="date">
                                <button type="text" id="btnSubmitSearch" class="btn btn-info btn-sm">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="customer-table table-responsive">
                                <table id="data" class="table table-bordered table-striped table-hover
                                    product-page-table-font-size">
                                    <thead>
                                        <tr>
                                            <th>Purchase id</th>
                                            <th>Product Name</th>
                                            <th>Supplier</th>
                                            <th>Purchase By</th>
                                            <th>Date</th>
                                            <th>Total Amount</th>
                                            <th>Paid Amount</th>
                                            <th>Due Amount</th>
                                            <th>Pay</th>
                                            <th>Option</th>
                                            <th style="display: none">created at</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($ads1->status == 'on')
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-12" style="display: flex;justify-content: center;">
                                {!! html_entity_decode($ads1->code)!!}
                                <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    Edit Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('p-update')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-11">
                            <input type="hidden" name="id" id="data_id" value="">
                            <label for="">Name</label><br>
                            <input type="text" class="form-control mb-3" name="product_name" id="data_product_name" value="" required>
                            <label for="">Category</label><br>
                            <input type="text" class="form-control mb-3" name="product_category" id="data_product_category" value="" required>
                            <label for="">Store In</label><br>
                            <input type="text" class="form-control mb-3" name="store_in" id="data_store_in" value="">
                            <label for="">Batch No</label><br>
                            <input type="text" class="form-control mb-3" name="batch" id="data_batch" value="" required>
                            <label for="">Purchase Rate</label><br>
                            <input type="text" class="form-control mb-3" name="purchase_rate" id="data_purchase_rate" value="" required>
                            <label for="">Selling Rate</label><br>
                            <input type="text" class="form-control mb-4" name="selling_rate" id="data_selling_rate" value="" required>

                            <input type="hidden" class="form-control mb-3" name="qty" id="data_qty" value="" required>
                            <label for="">Company</label><br>
                            <input type="text" class="form-control mb-3" name="company" id="data_company" value="">
                            <label for="">Mfg. Date</label><br>
                            <input type="date" class="form-control mb-3" name="mfg_date" id="data_mfg_date" value="" required>
                            <label for="">Exp. Date</label><br>
                            <input type="date" class="form-control mb-3" name="exp_date" id="data_exp_date" value="" required>
                            <label for="">Details</label><br>
                            <input type="text" class="form-control mb-3" name="details" id="data_details" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="new-customer-button mt-3" style="padding: 5px 10px; color: #fff;"><i class="fa fa-edit"></i> Update </button>
                    <button type="button" class="green-button mt-3" data-dismiss="modal" style="padding: 5px 10px; color: #fff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="view_purchase_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    Product Purchase Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                            <div class="row">
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
                                                        <h5> INVOICE NUMBER </h5>
                                                        <h5> DATE OF ISSUE   </h5><br><br>
                                                        <h5> BILLED TO </h5>
                                                        <h5>  </h5>
                                                        <h5> </h5>
                                                    </div>
                                                    <div class="col-md-6" style="margin-top: 100px; text-align: right;">
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
                                                        <th style="width:35%"><h5>PRODUCT NAME</h5></th>
                                                        <th style="width:15%"><h5>SUPPLIER</h5></th>
                                                        <th style="width:10%"><h5>UNIT COST</h5></th>
                                                        <th style="width:10%"><h5>QUANTITY</h5></th>
                                                        <th style="width:10%"><h5>AMOUNT</h5></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr style=" border-bottom: 2px solid #000;">
                                                            <td><p id="data_product_name"></p></td>
                                                            <td ></td>

                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <br>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <h5> INVOICE TOTAL </h5>
                                                        <h1 style="color: #1a4993;"> {{$invoice_info->currency}}  </h1>
                                                    </div>
                                                    <div class="col-md-9">

                                                        <table style="width:100%;">
                                                            <tr>
                                                                <th style="width:30%"></th><th style="width:10%"></th>
                                                                <th style="width:15%"></th><th style="width:26%;"></th><th style="width:14%"></th>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"></td><td><h5>SUB TOTAL</h5></td><td><h5>0</h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"></td><td><h5>GRAND TOTAL</h5></td><td><h5>0</h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"></td><td><h5>TOTAL DISCOUNT</h5></td><td><h5>0</h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"></td><td><h5>TAX/VAT</h5></td><td><h5>0</h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"></td><td><h5>SERVICE CHARGE</h5></td><td><h5>0</h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"></td><td><h5>PAID AMOUNT</h5></td><td><h5>0</h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"></td><td><h5>DUE AMOUNT</h5></td><td><h5>0</h5></td>
                                                            </tr>
                                                        </table>

                                                    </div>
                                                </div>
                                                <br><br><br><br>
                                                <h5> INVOICE CREATED BY: {{Session::get('loggedUser')['fname']}} {{Session::get('loggedUser')['lname']}}</h5>
                                                <h5>DATE: 0</h5><br>
                                                <!--                                <footer style="position: absolute;bottom: 0;text-align:right;width: 100%;height: 2.5rem;"> <h5>Powered By sozashop.com </h5></footer>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-trash margin-right-css"></i>
                    Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('p-destroy')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="product-add-form"> <h6> Are you sure you want to delete this? </h6> </div>
                    <input type="hidden" name="id" id="data_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="red-button mt-3" style="padding: 5px 10px; color: #fff;"><i class="fa fa-trash"></i> Delete </button>
                    <button type="button" class="green-button mt-3" data-dismiss="modal" style="padding: 5px 10px; color: #fff;">Cancel </button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('custom_plugin.js_files')

<script type="text/javascript">
    $('#view_purchase_invoice').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_product_name = button.data('product_id');
        console.log(data_product_name);
        var modal = $(this);
        modal.find('.modal-body td #data_product_name').val(data_product_name);

    });
    $('#edit_product').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id'); var data_product_name = button.data('product_name');
        var data_product_category = button.data('product_category'); var data_store_in = button.data('store_in');
        var data_qty = button.data('qty'); var data_batch = button.data('batch'); var data_purchase_rate = button.data('purchase_rate');
        var data_selling_rate = button.data('selling_rate');var data_company = button.data('company'); var data_mfg_date = button.data('mfg_date');
        var data_exp_date = button.data('exp_date'); var data_details = button.data('details');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id); modal.find('.modal-body #data_product_name').val(data_product_name);
        modal.find('.modal-body #data_product_category').val(data_product_category); modal.find('.modal-body #data_store_in').val(data_store_in);
        modal.find('.modal-body #data_batch').val(data_batch); modal.find('.modal-body #data_purchase_rate').val(data_purchase_rate);
        modal.find('.modal-body #data_selling_rate').val(data_selling_rate); modal.find('.modal-body #data_qty').val(data_qty);
        modal.find('.modal-body #data_company').val(data_company);modal.find('.modal-body #data_mfg_date').val(data_mfg_date);
        modal.find('.modal-body #data_exp_date').val(data_exp_date); modal.find('.modal-body #data_details').val(data_details);
    });
    $(document).ready(function () {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        var table = $('#data').DataTable({
            responsive: true,
            dom: 'lBfrtip', processing: true, serverSide: true, "order": [[ 2, "desc" ]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            ajax: {
                url: "{{ route('purchase-getData') }}",
                type: 'GET',
                data: function (d) {
                    d.start_date = $('#froms').val(); d.end_date = $('#tos').val();
                }
            },
            columns: [
                {data:'purchase_id', name:'purchase_id'},
                {data:'product_name', name:'product_name'},
                {data:'company', name:'company'},
                {data:'purchase_by', name:'purchase_by'},
                {data:'purchase_rate', name:'purchase_rate', searchable:false},
                {data:'selling_rate', name:'selling_rate', searchable:false},
                {data:'qty', name:'qty', searchable:false},

                {data:'total_amount', name:'total_amount', searchable:false},
                {data:'option', name:'option', orderable:false, searchable:false},
                {data:'created_at', name:'created_at', visible:false, searchable:false},
            ],
            "fnDrawCallback": function () {
                if ($("#TableAds").html()) {
                    var gnTr = document.createElement( 'tr' ); var nCell = document.createElement( 'td' );
                    nCell.colSpan = 12; nCell.align = 'center'; nCell.innerHTML = $('#Ads').html();
                    gnTr.appendChild( nCell ); var nTrs = $('#data tbody tr');
                    nTrs[0].parentNode.insertBefore( gnTr, nTrs[0] );
                }
            },
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(); nb_cols = api.columns().nodes().length; var j = 5;
                while(j < nb_cols && j < 8){
                    var pageTotal = api.column( j, { page: 'current'} ).data().reduce( function (a, b) {
                        return Number(a) + Number(b); }, 0 );
                    $( api.column( j ).footer() ).html('Total: ' + pageTotal.toFixed(2));
                    j++;
                }
            },
            buttons: [
                {extend: 'copy', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}},
                {extend: 'csv', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}},
                {extend: 'excel', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}},
                {extend: 'pdf', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}},
                {extend: 'print', autoPrint: true, exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}},
            ],
        });new $.fn.dataTable.FixedHeader( table );
    });
    $('#btnSubmitSearch').click(function(){ $('#data').DataTable().draw(true); });

    function printForm(divName) {
        var printContents = document.getElementById(divName).innerHTML;var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents; window.print(); document.body.innerHTML = originalContents;
    }

</script>
@include('custom_plugin.datatable_files')
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection

<!--<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>-->
<!--<ins class="adsbygoogle"-->
<!--     style="display:inline-block;width:728px;height:90px"-->
<!--     data-ad-client="ca-pub-1234567890123456"-->
<!--     data-ad-slot="1234567890"></ins>-->
<!--<script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>-->
