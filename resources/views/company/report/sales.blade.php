@extends('layout.company.masterpage')
@section('title', 'Sales Ledger')
@section('masterpage')
@if(in_array('report', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Sales Ledger</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Sales Ledger</a>
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
                            <h2>Sales Ledger Data</h2>
                            <small>Data range</small>
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
                                        <th class="align-middle" align="center">Invoice No</th>
                                        <th class="align-middle" align="center">Customer Name</th>
                                        <th class="align-middle" align="center">Date</th>
                                        <th class="align-middle" align="center">Total Amount</th>
                                        <th class="align-middle" align="center">Paid Amount</th>
                                        <th class="align-middle" align="center">Remaining Amount</th>
                                        <th class="align-middle" align="center">{{$logo->vat_type}}</th>
                                        <th class="align-middle" align="center">{{$logo->service_type}}</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        <td class="align-middle" align="center"></td><td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td><td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td><td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td><td class="align-middle" align="center"></td>
                                    </tr>
                                    <tr class="star-stuff-table-desktop-view">
                                        <td class="align-middle" align="center" colspan="3"></td>
                                        <td class="align-middle" align="center">Grand Total <?php echo number_format($total, 2, '.', ',');;?></td>
                                        <td class="align-middle" align="center">Grand Total <?php echo number_format($paid, 2, '.', ',');?></td>
                                        <td class="align-middle" align="center">Grand Total <?php echo number_format($due, 2, '.', ',');?></td>
                                        <td class="align-middle" align="center">Grand Total <?php echo number_format($vat, 2, '.', ',');?></td>
                                        <td class="align-middle" align="center">Grand Total <?php echo number_format($service, 2, '.', ',');?></td>
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
                                                <h5><?php echo  number_format($total, 2, '.', ',');?></h5>
                                                <p>Grand Total Amount</p>
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
                                            <div class="single-revinew-text"><h5><?php echo number_format($paid, 2, '.', ',');?></h5>
                                                <p>Grand Total Paid</p>
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
                                            <div class="single-revinew-text"><h5><?php echo number_format($due, 2, '.', ',');?></h5>
                                                <p>Grand Total Remaining</p>
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
                                            <div class="single-revinew-text"><h5><?php echo number_format($vat, 2, '.', ',');?></h5>
                                                <p>{{$logo->vat_type}}</p>
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
                                            <div class="single-revinew-text"><h5><?php echo number_format($service, 2, '.', ',');?></h5>
                                                <p>{{$logo->service_type}}</p>
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
            dom: 'lBfrtip', processing: true, serverSide: true, "order": [[ 0, "desc" ]],
            ajax: {
                url: "{{ route('sales-getData') }}",
                type: 'GET',
                data: function (d) {
                    d.start_date = $('#froms').val(); d.end_date = $('#tos').val();
                }
            },
            columns: [
                {data:'sales_no', name:'sales_no'},
                {data:'cus_name', name:'cus_name'},
                {data:'date', name:'date', searchable:false},
                {data:'grand_total', name:'grand_total', searchable:false},
                {data:'paid', name:'paid', searchable:false},
                {data:'remaining', name:'remaining', searchable:false},
                {data:'vat_cost', name:'remaining', searchable:false},
                {data:'service_cost', name:'remaining', searchable:false},
            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(); nb_cols = api.columns().nodes().length; var j = 3;
                while(j < nb_cols){
                    var pageTotal = api
                        .column( j, { page: 'current'} ).data().reduce( function (a, b) {
                            return Number(a) + Number(b); }, 0 ); // Update footer
                    $( api.column( j ).footer() ).html('Total: ' + pageTotal.toFixed(2));
                    j++;
                }
            },
            "fnDrawCallback": function () {
                if ($("#TableAds").html()) {
                    var gnTr = document.createElement( 'tr' ); var nCell = document.createElement( 'td' );
                    nCell.colSpan = 9; nCell.align = 'center';nCell.innerHTML = $('#Ads').html();
                    gnTr.appendChild( nCell ); var nTrs = $('#data tbody tr');
                    nTrs[0].parentNode.insertBefore( gnTr, nTrs[0] );
                }
            },
            buttons: [
                {extend: 'copy', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7]}},
                {extend: 'csv', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7]}},
                {extend: 'excel', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7]}},
                {extend: 'pdf', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7]}},
                {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7]}},
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
