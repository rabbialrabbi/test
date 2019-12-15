@extends('layout.company.masterpage')
@section('title', 'Manage Loan')
@section('masterpage')
@if(in_array('loan', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Loans List</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Loans List</a>
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
                            <h2>Exporting Loans Data</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="customer-table table-responsive">
                                <table id="data" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <td class="align-middle" align="center">Loaner Name</td>
                                        <td class="align-middle" align="center">Mobile</td>
                                        <td class="align-middle" align="center">Date Contract Start</td>
                                        <td class="align-middle" align="center">Contact Ended</td>
                                        <td class="align-middle" align="center">Loan Type</td>
                                        <td class="align-middle" align="center">Loan Amount</td>
                                        <td class="align-middle" align="center">Interest</td>
                                        <td class="align-middle" align="center">Total Amount</td>
                                        <td class="align-middle" align="center">Amount returned</td>
                                        <td class="align-middle" align="center">Remaining Amount</td>
                                        <td class="align-middle" align="center">Option</td>
                                        <td style="display: none;">Created at</td>
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
                                        <td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td>
                                        <td class="align-middle" align="center"></td>
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
                                                <p>Amount Returned</p>
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

<div class="modal fade" id="loan-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    Edit Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('loan-update')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-11">
                            <input type="hidden" name="id" id="data_id" value="">
                            <label for="">Loaner Name</label><br>
                            <input type="text" class="form-control mb-3" name="loaner" id="data_loaner" value="" required>
                            <label for="">Mobile</label><br>
                            <input type="text" class="form-control mb-3" name="mobile" id="data_mobile" value="" required>
                            <label for="">Date Contract Start</label><br>
                            <input type="date" class="form-control mb-3" name="contract_start" id="data_contract_start" value="" required>
                            <label for="">Contact Ended</label><br>
                            <input type="date" class="form-control mb-3" name="contract_end" id="data_contract_end" value="" required>
                             <label for="">Loan Amount</label><br>
                            <input type="text" class="form-control mb-3" name="loan" id="data_loan" value="" required>
                            <label for="">Interest</label><br>
                            <input type="text" class="form-control mb-3" name="interest" id="data_interest" value="">
                             <label for="">Loan Type</label><br>
                            <select class="mb-3 form-control" name="type" id="data_type" required>
                                <option value="">Select Loan Type</option>
                                <option value="taken">Taken</option>
                                <option value="given">Given</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="new-customer-button mt-3" style="padding: 5px 10px; color: #fff;"><i
                            class="fa fa-edit"></i> Update
                    </button>
                    <button type="button" class="green-button mt-3" data-dismiss="modal"
                            style="padding: 5px 10px; color: #fff;">Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="loan-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    Loan Detail Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="product-add-form">
                    <h6><strong> Detail Information </strong></h6>
                </div>
                <div class="row">

                    <div class="col-md-8">
                         <label style="font-weight:800;" for="">Loaner Name:</label>
                        <label id="data_loaner"></label><br>
                         <label style="font-weight:800;" for="">Mobile:</label>
                        <label id="data_mobile"></label><br>
                        <label style="font-weight:800;" for="">Date Contract Start:</label>
                        <label id="data_contract_start"></label><br>
                        <label style="font-weight:800;" for="">Contact Ended:</label>
                        <label id="data_contract_end"></label><br>
                         <label style="font-weight:800;" for="">Loan Amount:</label>
                        <label id="data_loan"></label><br>
                        <label style="font-weight:800;" for="">Amount returned:</label>
                        <label id="data_returned"></label><br>
                        <label style="font-weight:800;" for="">Interest:</label>
                        <label id="data_interest"></label><br>
                         <label style="font-weight:800;" for="">Total Amount:</label>
                        <label id="data_total_amount"></label><br>
                        <label style="font-weight:800;" for="">Remaining Amount:</label>
                        <label id="data_remaining"></label><br>
                        <label style="font-weight:800;" for="">Loan Type:</label>
                        <label id="data_type"></label><br><br>
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
                <h5 class="modal-title text-center" id="exampleModalLabel"> Loan Pay </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('loan-pay')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-11">
                            <input type="hidden" name="id" id="data_id" value="">
                             <label for="">Due Amount </label><br>
                            <input type="text" class="form-control mb-3" id="data_due" value="" disabled>
                            <label for="">Amount Returned </label><br>
                            <input type="text" class="form-control mb-3" name="returned" value="" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="green-button mt-3" style="padding: 5px 10px; color: #fff;">
                        <i class="fa fa-edit"></i> Submit
                    </button>
                    <button type="button" class="green-button mt-3" data-dismiss="modal"
                            style="padding: 5px 10px; color: #fff;">Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-trash margin-right-css"></i>
                    Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('loaner-destroy')}}" method="post">
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
    $('#loan-edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id');
        var data_loaner = button.data('loaner');
        var data_mobile = button.data('mobile');
        var data_contract_start = button.data('contract_start');
        var data_loan = button.data('loan');
        var data_contract_end = button.data('contract_end');
        var data_interest = button.data('interest');
        var data_type = button.data('type');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id);
        modal.find('.modal-body #data_loaner').val(data_loaner);
        modal.find('.modal-body #data_mobile').val(data_mobile);
        modal.find('.modal-body #data_contract_start').val(data_contract_start);
        modal.find('.modal-body #data_loan').val(data_loan);
        modal.find('.modal-body #data_contract_end').val(data_contract_end);
        modal.find('.modal-body #data_interest').val(data_interest);
        modal.find('.modal-body #data_type').val(data_type);
    });
    $('#loan-view').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_loaner = button.data('loaner');
        var data_mobile = button.data('mobile');
        var data_contract_start = button.data('contract_start');
        var data_loan = button.data('loan');
        var data_returned = button.data('returned');
        var data_contract_end = button.data('contract_end');
        var data_interest = button.data('interest');
        var data_total_amount = button.data('total_amount');
        var data_remaining = button.data('remaining');
        var data_type = button.data('type');
        var modal = $(this);
        modal.find('.modal-body #data_loaner').html(data_loaner);
        modal.find('.modal-body #data_mobile').html(data_mobile);
        modal.find('.modal-body #data_contract_start').html(data_contract_start);
        modal.find('.modal-body #data_loan').html(data_loan);
        modal.find('.modal-body #data_returned').html(data_returned);
        modal.find('.modal-body #data_contract_end').html(data_contract_end);
        modal.find('.modal-body #data_interest').html(data_interest);
        modal.find('.modal-body #data_total_amount').html(data_total_amount);
        modal.find('.modal-body #data_remaining').html(data_remaining);
        modal.find('.modal-body #data_type').html(data_type);
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
            responsive: false,
            dom: 'lBfrtip', processing: true, serverSide: true, "order": [[ 11, "desc" ]],
            ajax: "{{ route('loan-getData') }}",
            columns: [
                {data:'loaner', name:'loaner'},
                {data:'mobile', name:'mobile'},
                {data:'contract_start', name:'contract_start', searchable:false},
                {data:'contract_end', name:'contract_end', searchable:false},
                {data:'type', name:'type'},
                {data:'loan', name:'loan', searchable:false},
                {data:'interest', name:'interest', searchable:false},
                {data:'total_amount', name:'total_amount', searchable:false},
                {data:'returned', name:'returned', searchable:false},
                {data:'remaining', name:'remaining', searchable:false},
                {data:'option', name:'option', searchable:false},
                {data:'created_at', name:'created_at', visible:false, searchable:false},
            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(); nb_cols = api.columns().nodes().length; var j = 7;
                while(j < nb_cols && j < 10){
                    var pageTotal = api.column( j, { page: 'current'} ).data().reduce( function (a, b) {
                            return Number(a) + Number(b); }, 0 );
                    $( api.column( j ).footer() ).html('Total: ' + pageTotal.toFixed(2)); j++;
                }
            },
            "fnDrawCallback": function () {
                if ($("#TableAds").html()) {
                    var gnTr = document.createElement( 'tr' ); var nCell = document.createElement( 'td' );
                    nCell.colSpan = 13; nCell.align = 'center';nCell.innerHTML = $('#Ads').html();gnTr.appendChild( nCell );
                    var nTrs = $('#data tbody tr');nTrs[0].parentNode.insertBefore( gnTr, nTrs[0] );
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
</script>
@include('custom_plugin.datatable_files')
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection
