@extends('layout.company.masterpage')
@section('title', 'Expenses Ledger')
@section('masterpage')
@if(in_array('report', explode(",", Session::get('loggedUser')['role']  )))
        <div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
            <div class="row dashboard-right-content">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="bread-cumb-area">
                                <h2>Expense Ledger</h2>
                                <a href="#">Dashboard</a>
                                <a href="#">Expense Ledger</a>
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
                                    <h2>Expense Ledger Data</h2>
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
                                                <th class="align-middle" align="center">Invoice No</th>
                                                <th class="align-middle" align="center">Expense Type</th>
                                                <th class="align-middle" align="center">Created by Name</th>
                                                <th class="align-middle" align="center">Date</th>
                                                <th class="align-middle" align="center">Total Amount</th>
                                                <th class="align-middle" align="center">Paid Amount</th>
                                                <th class="align-middle" align="center">Remaining Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                            <tr >
                                                <td class="align-middle" align="center"></td>
                                                <td class="align-middle" align="center"></td>
                                                <td class="align-middle" align="center"></td>
                                                <td class="align-middle" align="center"></td>
                                                <td class="align-middle" align="center"></td>
                                                <td class="align-middle" align="center"></td>
                                                <td class="align-middle" align="center"></td>
                                            </tr>
                                            <tr class="star-stuff-table-desktop-view">
                                                <td class="align-middle" align="center" colspan="4"></td>
                                                <td class="align-middle" align="center">Grand Total <?php echo number_format($total, 2, '.', ',');?></td>
                                                <td class="align-middle" align="center">Grand Total <?php echo number_format($paid, 2, '.', ',');?></td>
                                                <td class="align-middle" align="center">Grand Total <?php echo number_format($due, 2, '.', ',');?></td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        
                                 
                             <!--starstuff Table SetUp   START-->
                     <div class="col-md-12 star-stuff-table-mobile-view star-margin-top-lg">
                        <div class="row">
                            

                            <div class="col-md-4 total">
                                <div class="single-revinew star-bg-blue text-center">
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
                            <div class="col-md-4 paid">
                                <div class="single-revinew star-bg-purple text-center">
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
                            <div class="col-md-4 due">
                                <div class="single-revinew star-bg-green text-center">
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
                url: "{{ route('expense-getData') }}",
                type: 'GET',
                data: function (d) {
                    d.start_date = $('#froms').val(); d.end_date = $('#tos').val();
                }
            },
            columns: [
                {data:'invoice_no', name:'invoice_no'},
                {data:'expense_type', name:'expense_type'},
                {data:'created_by', name:'created_by'},
                {data:'date', name:'date', searchable:false},
                {data:'grand_total', name:'grand_total', searchable:false},
                {data:'paid', name:'paid', searchable:false},
                {data:'due', name:'due', searchable:false},
            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(); nb_cols = api.columns().nodes().length; var j = 4;
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
                    nCell.colSpan = 8; nCell.align = 'center'; nCell.innerHTML = $('#Ads').html();
                    gnTr.appendChild( nCell ); var nTrs = $('#data tbody tr');
                    nTrs[0].parentNode.insertBefore( gnTr, nTrs[0] );
                }
            },
            buttons: [
                {extend: 'copy', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6]}},
                {extend: 'csv', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6]}},
                {extend: 'excel', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6]}},
                {extend: 'pdf', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6]}},
                {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6]}}
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
