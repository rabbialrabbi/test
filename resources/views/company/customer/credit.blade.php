@extends('layout.company.masterpage')
@section('title', 'Credit Customers')
@section('masterpage')
@if(in_array('customer', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Credit Customers Invoices List</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Credit Customers Invoices list</a>
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
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Exporting Credit Customers Invoices Data</h2>
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
                                        <th class="align-middle" align="center">Option</th>
                                        <th style="display: none">Created at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td>
                                        <td style="display: none"></td>
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
                            <div class="col-md-4">
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

<div class="modal fade" id="cus-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    Loaner Detail Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="product-add-form">
                    <h6><strong> Detail Information </strong></h6>
                </div>
                <div class="row">

                    <div class="col-md-8">
                         <label style="font-weight:800;" for="">Invoice No: </label>
                        <label id="data_sales_no"></label><br>
                          <label style="font-weight:800;" for="">Customer Name: </label>
                        <label id="data_cus_name"></label><br>
                         <label style="font-weight:800;" for="">Date: </label>
                        <label id="data_date"></label><br>
                        <label style="font-weight:800;" for="">Total Amount: </label>
                        <label id="data_grand_total"></label> Tk.<br>
                        <label style="font-weight:800;" for="">Paid: </label>
                        <label id="data_paid"></label> Tk.<br>
                        <label style="font-weight:800;" for="">Remaining Amount: </label>
                        <label id="data_remaining"></label> Tk.<br>
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
            <form action="{{route('sl-pay')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-7">
                            <input type="hidden" name="id" id="data_id" value="">
                            <label for="">Due Amount </label><br>
                            <input type="text" class="form-control mb-3" id="data_due" value="" disabled>
                            <label for="">Amount Returned </label><br>
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
            <form action="{{route('sl-destroy')}}" method="post">
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
    $('#cus-view').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_cus_name = button.data('cus_name');
        var data_sales_no = button.data('sales_no');
        var data_date = button.data('date');
        var data_grand_total = button.data('grand_total');
        var data_paid = button.data('paid');
        var data_remaining = button.data('remaining');

        var modal = $(this);
        modal.find('.modal-body #data_cus_name').html(data_cus_name);
        modal.find('.modal-body #data_sales_no').html(data_sales_no);
        modal.find('.modal-body #data_date').html(data_date);
        modal.find('.modal-body #data_grand_total').html(data_grand_total);
        modal.find('.modal-body #data_paid').html(data_paid);
        modal.find('.modal-body #data_remaining').html(data_remaining);
    });
    $('#pay').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id');
        var data_due = button.data('due');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id);
        modal.find('.modal-body #data_due').val(data_due);
    });

    $(document).ready(function () {
       var table = $('#data').DataTable({
            responsive: true,
            dom: 'lBfrtip', processing: true, serverSide: true, "order": [[ 7, "desc" ]],
            ajax: "{{ route('credit-customer-getData') }}",
            columns: [
                {data:'sales_no', name:'sales_no'},
                {data:'cus_name', name:'cus_name'},
                {data:'date', name:'date', searchable:false},
                {data:'grand_total', name:'grand_total', searchable:false},
                {data:'paid', name:'paid', searchable:false},
                {data:'remaining', name:'remaining', searchable:false},
                {data:'option', name:'option', searchable:false},
                {data:'created_at', name:'created_at', visible:false, searchable:false},
            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(); nb_cols = api.columns().nodes().length; var j = 3;
                while(j < nb_cols && j < 6){
                    var pageTotal = api.column( j, { page: 'current'} ).data().reduce( function (a, b) {
                        return Number(a) + Number(b); }, 0 );
                    $( api.column( j ).footer() ).html('Total: ' + pageTotal.toFixed(2)); // Update footer
                    j++;
                }
            },
            "fnDrawCallback": function () {
                if ($("#TableAds").html()) {
                    var gnTr = document.createElement( 'tr' ); var nCell = document.createElement( 'td' );
                    nCell.colSpan = 8; nCell.align = 'center';nCell.innerHTML = $('#Ads').html();
                    gnTr.appendChild( nCell ); var nTrs = $('#data tbody tr');
                    nTrs[0].parentNode.insertBefore( gnTr, nTrs[0] );
                }
            },
            buttons: [
                {extend: 'copy', exportOptions: {columns: [0, 1, 2, 3, 4, 5]}},
                {extend: 'csv', exportOptions: {columns: [0, 1, 2, 3, 4, 5]}},
                {extend: 'excel', exportOptions: {columns: [0, 1, 2, 3, 4, 5]}},
                {extend: 'pdf', exportOptions: {columns: [0, 1, 2, 3, 4, 5]}},
                {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4, 5]}},
            ]
        });
        new $.fn.dataTable.FixedHeader( table );
    });
</script>
@include('custom_plugin.datatable_files')
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection
