@extends('layout.company.masterpage')
@section('title', 'Manage Expense Invoice')
@section('masterpage')
@if(in_array('expense', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Expense Invoice List</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Expense Invoice List</a>
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
                        <div class="col-md-4">
                            <h2>Exporting Expense Invoice Data</h2>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-category-search">
                                <label>From</label>
                                <input class="input-search-product" name="froms" id="froms" type="date">
                                <label>To</label>
                                <input class="input-search-product" name="tos" id="tos" type="date">
                                <button type="text" id="btnSubmitSearch" class="btn btn-info btn-sm">Submit</button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn-group product-inline-btn margin-right-css">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"> All
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{route('m-invoice')}}" style="text-decoration: none;">
                                        <button class="dropdown-item" style="cursor: pointer;" type="button">All</button></a>
                                    <a href="{{route('m-invoice-paid')}}" style="text-decoration: none;">
                                        <button class="dropdown-item" style="cursor: pointer;" type="button">Paid</button></a>
                                    <a href="{{route('m-invoice-unpaid')}}" style="text-decoration: none;">
                                        <button class="dropdown-item" style="cursor: pointer;" type="button">Unpaid</button></a>
                                </div>
                            </div>
                            <small>records per page</small>
                        </div>
                    </div>
                    <br>
                    @isset($pay) <input type="hidden" name="pay" id="pay" value="{{$pay}}"> @endisset
                    @isset($unpay) <input type="hidden" name="unpay" id="unpay" value="{{$unpay}}"> @endisset
                    <div class="row">
                        <div class="col-md-12">
                            <div class="customer-table table-responsive">
                                <table id="data" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Invoice No</th><th>Expense Type</th><th>Created by Name</th><th>Date</th>
                                        <th>Total Amount</th><th>Paid Amount</th><th>Remaining Amount</th><th>Pay</th><th>Option</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td class="align-middle" align="center"></td><td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td><td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td><td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td><td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="single-revinew text-center">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="single-revinew-text"><h5>{{$logo->currency}}
                                                    <?php echo number_format($total, 2, '.', ',');?></h5>
                                                <p>Total Amount</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3"><div class="single-revinew-icon"> <i class="far fa-chart-bar"></i> </div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-revinew-two text-center">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="single-revinew-text"> <h5>{{$logo->currency}}
                                                    <?php echo number_format($paid, 2, '.', ',');?></h5>
                                                <p>Paid Amount</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3"><div class="single-revinew-icon"> <i class="far fa-chart-bar"></i> </div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <div class="single-revinew-three text-center">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="single-revinew-text"> <h5>{{$logo->currency}}
                                                    <?php echo number_format($due, 2, '.', ',');?></h5>
                                                <p>Remaining Amount</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4"><div class="single-revinew-icon"> <i class="far fa-chart-bar"></i> </div></div>
                                    </div>
                                </div>
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

<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    Expense Detail Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="product-add-form">
                    <h6><strong> Detail Information </strong></h6>
                </div>
                <div class="row">
 
                    <div class="col-md-11">
                        <label style="font-weight:800;" for="">Invoice No: </label><label id="data_invoice"></label><br>
                         <label style="font-weight:800;" for="">Created By: </label><label id="data_created_by"></label><br>
                        <label style="font-weight:800;" for="">Date: </label><label id="data_date"></label><br>
                        <label style="font-weight:800;" for="">Total Amount: </label> <label id="data_total"></label> Tk.<br>
                         <label style="font-weight:800;" for="">Paid Amount: </label><label id="data_paid"></label> Tk.<br>
                        <label style="font-weight:800;" for="">Remaining Amount: </label><label id="data_due"></label> Tk.<br>
                    </div>
                </div>
                <button type="button" class="green-button mt-10" data-dismiss="modal"
                        style="padding: 5px 10px; color: #fff;" align="right">Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"> Amount Pay </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('m-invoice-pay')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Due Amount </label><br><br>
                            <label for="">Amount Returned </label><br><br>
                        </div>
                        <div class="col-md-7">
                            <input type="hidden" name="id" id="data_id" value="">
                            <input type="text" class="form-control mb-3" id="data_due" value="" disabled>
                            <input type="text" class="form-control mb-3" name="paid" value="" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="new-customer-button mt-3" style="padding: 5px 10px; color: #fff;">
                        <i class="fa fa-edit"></i> Update
                    </button>
                    <button type="button" class="green-button mt-3" data-dismiss="modal"
                            style="padding: 5px 10px; color: #fff;">Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-trash margin-right-css"></i>
                    Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('m-invoice-destroy')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="product-add-form">
                        <h6> Are you sure you want to delete this? </h6>
                    </div>
                    <input type="hidden" name="id" id="data_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="red-button mt-3" style="padding: 5px 10px; color: #fff;"><i
                            class="fa fa-trash"></i> Delete
                    </button>
                    <button type="button" class="green-button mt-3" data-dismiss="modal"
                            style="padding: 5px 10px; color: #fff;">Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('custom_plugin.js_files')

<script>
    $('#pay').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id');
        var data_due = button.data('due');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id);
        modal.find('.modal-body #data_due').val(data_due);
    });
    $('#view').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_invoice = button.data('invoice');
        var data_created_by = button.data('created_by');
        var data_date = button.data('date');
        var data_total = button.data('total');
        var data_paid = button.data('paid');
        var data_due = button.data('due');

        var modal = $(this);
        modal.find('.modal-body #data_invoice').html(data_invoice);
        modal.find('.modal-body #data_created_by').html(data_created_by);
        modal.find('.modal-body #data_date').html(data_date);
        modal.find('.modal-body #data_total').html(data_total);
        modal.find('.modal-body #data_paid').html(data_paid);
        modal.find('.modal-body #data_due').html(data_due);
    });
    $(document).ready(function () {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
       var table = $('#data').DataTable({
            responsive: true,

            dom: 'lBfrtip', processing: true, serverSide: true, "order": [[ 0, "desc" ]],
            ajax: {
                url: "{{ route('manage-exp-getData') }}",
                type: 'GET',
                data: function (d) {
                    d.start_date = $('#froms').val(); d.end_date = $('#tos').val();
                    d.pay = $('#pay').val(); d.unpay = $('#unpay').val();
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
                {data:'pay', name:'pay', searchable:false},
                {data:'option', name:'option', searchable:false},
            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(); nb_cols = api.columns().nodes().length; var j = 4;
                while(j < nb_cols && j < 7){
                    var pageTotal = api.column( j, { page: 'current'} ).data().reduce( function (a, b) {
                        return Number(a) + Number(b); }, 0 );
                    $( api.column( j ).footer() ).html('Total: ' + pageTotal.toFixed(2)); // Update footer
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
    $('#pay').click(function(){ $('#data').DataTable().draw(true); });
    $('#unpay').click(function(){ $('#data').DataTable().draw(true); });
</script>
@include('custom_plugin.datatable_files')
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection
