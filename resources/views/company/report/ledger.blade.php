@extends('layout.company.masterpage')
@section('title', 'Sales Profit/Loss Ledger')
@section('masterpage')
@if(in_array('report', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Profit/Loss Ledger</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Profit/Loss Ledger</a>
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
            <div class="row new-sales-table-bg star-top-bottom-padding">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Profit/Loss Ledger</h2>
                            <small>Date range</small>
                        </div>
                    </div>
                    <div class="row manage-sales-top">
                        <div class="col-md-12">
                            <input class="report-form" name="froms" id="froms" type="date">
                            <b class="m-3">To</b>
                            <input class="report-form" name="tos" id="tos" type="date">
                            <button type="text" id="btnSubmitSearch" class="btn btn-info btn-sm">Search</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="customer-table table-responsive">
                                <table id="data" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="align-middle" align="center">Date</th>
                                            <th class="align-middle" align="center">Invoice No</th>
                                            <th class="align-middle" align="center">Product</th>
                                            <th class="align-middle" align="center">Purchase Price</th>
                                            <th class="align-middle" align="center">Quantity</th>
                                            <th class="align-middle" align="center">Total Purchase Cost</th>
                                            <th class="align-middle" align="center">Sale Price</th>
                                            <th class="align-middle" align="center">Discount/Item</th>
                                            <th class="align-middle" align="center">Total</th>
                                            <th class="align-middle" align="center">Profit</th>
                                            <th style="display: none">Created at</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        <td class="align-middle" align="center"></td><td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td><td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td><td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td><td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td><td class="align-middle" align="center"></td>
                                    </tr>
                                    <tr class="star-stuff-table-desktop-view">
                                            <td class="align-middle" align="center" colspan="4"></td>
                                            <td class="align-middle" align="center">Grand Total <?php echo  number_format($qty, 2, '.', ',');?></td>
                                            <td class="align-middle" align="center">Grand Total <?php echo number_format($purchase, 2, '.', ',');?></td>
                                            <td class="align-middle" align="center"></td>
                                            <td class="align-middle" align="center">Grand Total <?php echo number_format($discount, 2, '.', ',');?></td>
                                            <td class="align-middle" align="center">Grand Total <?php echo number_format($total, 2, '.', ',');?></td>
                                            <td class="align-middle" align="center">Grand Total <?php echo number_format($profit, 2, '.', ',');?></td>
                                    </tr> 
                                   
                                    </tfoot>
                                </table>
                                
                             <!--starstuff Table SetUp   START-->
                     <div class="col-md-12 star-stuff-table-mobile-view star-margin-top-lg">
                        <div class="row">
                            
                            <div class="col-md-4 quantity">
                                <div class="single-revinew star-bg-red text-center">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="single-revinew-text">
                                                <h5><?php echo  number_format($qty, 2, '.', ',');?></h5>
                                                <p>Grand Total Quantity</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3"><div class="single-revinew-icon star-white"> <i class="far fa-chart-bar"></i> </div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 purchase-cost">
                                <div class="single-revinew star-bg-blue text-center">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="single-revinew-text"><h5><?php echo number_format($purchase, 2, '.', ',');?></h5>
                                                <p>Grand Total Purchase Cost</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3"><div class="single-revinew-icon star-white"> <i class="far fa-chart-bar"></i> </div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 discount-item">
                                <div class="single-revinew star-bg-yellow text-center">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="single-revinew-text"><h5><?php echo number_format($discount, 2, '.', ',');?></h5>
                                                <p>Grand Total Discount/Item</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3"><div class="single-revinew-icon star-white"> <i class="far fa-chart-bar"></i> </div></div>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-4 total">
                                <div class="single-revinew star-bg-purple text-center">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="single-revinew-text"><h5><?php echo number_format($total, 2, '.', ',');?></h5>
                                                <p>Grand Total Amount</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3"><div class="single-revinew-icon star-white"> <i class="far fa-chart-bar"></i> </div></div>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-4 Profit">
                                <div class="single-revinew star-bg-green text-center">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="single-revinew-text"><h5><?php echo number_format($profit, 2, '.', ',');?></h5>
                                                <p>Grand Total Profit</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3"><div class="single-revinew-icon star-white"> <i class="far fa-chart-bar"></i> </div></div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /row -->
                    </div>

                             <!--starstuff Table SetUp   END-->
        
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
@include('custom_plugin.js_files')
<script>
    $(document).ready(function () {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        var table = $('#data').DataTable({
            responsive: true,

            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            dom: 'lBfrtip', processing: true, serverSide: true, "order": [[ 1, "desc" ]],
            ajax: {
                url: "{{ route('ledger-getData') }}",
                type: 'GET',
                data: function (d) {
                    d.start_date = $('#froms').val(); d.end_date = $('#tos').val();
                }
            },
            columns: [
                {data:'date', name:'date', searchable:false},
                {data:'sales_no', name:'sales_no'},
                {data:'item', name:'item'},
                {data:'purchase_cost', name:'purchase_cost', searchable:false},
                {data:'qty', name:'qty', searchable:false},
                {data:'total_purchase', name:'total_purchase',searchable:false},
                {data:'sale_rate', name:'sale_rate', searchable:false},
                {data:'discount_cost', name:'discount_cost', searchable:false},
                {data:'total', name:'total', searchable:false},
                {data:'profit', name:'profit', searchable:false},
            ],

            "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(); nb_cols = api.columns().nodes().length; var j = 4;
                    while(j < nb_cols){
                        var pageTotal = api.column( j, { page: 'current'} ).data().reduce( function (a, b) {
                                return Number(a) + Number(b); }, 0 );
                        $( api.column( j ).footer() ).html('Total: ' + pageTotal.toFixed(2));
                        if(j === 5) {j = 6;}
                        j++;
                    }
                },
            "fnDrawCallback": function () {
                if ($("#TableAds").html()) {
                    var gnTr = document.createElement( 'tr' ); var nCell = document.createElement( 'td' );
                    nCell.colSpan = 10; nCell.align = 'center'; nCell.innerHTML = $('#Ads').html();
                    gnTr.appendChild( nCell ); var nTrs = $('#data tbody tr');
                    nTrs[0].parentNode.insertBefore( gnTr, nTrs[0] );
                }
            },
            buttons: [
                {extend: 'copy', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}},
                {extend: 'csv', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}},
                {extend: 'excel', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}},
                {extend: 'pdf', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}},
                {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}},
            ]
        });
        new $.fn.dataTable.FixedHeader( table );
    });
    $('#btnSubmitSearch').click(function(){ $('#data').DataTable().draw(true); });
</script>
 @include('custom_plugin.datatable_files')
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection
