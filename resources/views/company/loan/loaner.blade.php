@extends('layout.company.masterpage')
@section('title', 'Manage Loaners')
@section('masterpage')
@if(in_array('loan', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Loaners List</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Loaners List</a>
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
                            <h2>Exporting Loaners Data</h2>
                        </div>
                    </div>
                    <div class="row manage-sales-top">
                        <div class="col-md-3">
                            <button type="button" class="btn btn-success green-button" data-toggle="modal"
                                    data-target="#add-loaner"><i class="fas fa-plus mr-2"></i> Add Loaner
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="customer-table table-responsive">
                                <table id="data" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="align-middle" align="center">Loaner Name</th>
                                            <th class="align-middle" align="center">Mobile</th>
                                            <th class="align-middle" align="center">Email</th>
                                            <th class="align-middle" align="center">Address</th>
                                            <th class="align-middle" align="center">Option</th>
                                            <th style="display: none;">No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
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

<div class="modal fade" id="add-loaner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Loaner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="add-expense-area">
                            <div class="row">

                                <div class="col-md-12">
                                    <form action="{{route('loaner-add')}}" method="post">
                                        @csrf
                                        <label style="font-weight:800;" for="">Loaner</label><br>
                                        <input type="text" name="loaner" class="form-control mb-3"
                                               placeholder="Loaner Name" required>
                                               
                                        <label style="font-weight:800;" for="">Mobile</label><br>
                                        <input type="text" name="mobile" class="form-control mb-3"
                                               placeholder="Mobile" required>
                                               
                                         <label style="font-weight:800;" for="">Email</label><br>
                                        <input type="email" name="email" class="form-control mb-3"
                                               placeholder="Email">
                                               
                                        <label style="font-weight:800;" for="">Address</label><br>
                                        <input type="text" name="address" class="form-control mb-3"
                                               placeholder="Address">
                                        
                                        <input type="submit" class="btn btn-success mt-2" value="Submit">
                                        <button type="button" class="btn btn-info mt-2" data-dismiss="modal">Cancel
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="l-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
            <form action="{{route('loaner-update')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-8">
                            <input type="hidden" name="id" id="data_id" value="">
                            <label for="">Loaner Name</label><br>
                            <input type="text" class="form-control mb-3" name="loaner" id="data_loaner" value=""
                                   required>
                            <label for="">Mobile</label><br>
                            <input type="text" class="form-control mb-3" name="mobile" id="data_mobile" value=""
                                   required>
                            <label for="">Email</label><br>
                            <input type="text" class="form-control mb-3" name="email" id="data_email" value="" required>
                            <label for="">Address</label><br>
                            <input type="text" class="form-control mb-3" name="address" id="data_address" value=""
                                   required>
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

<div class="modal fade" id="l-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <label style="font-weight:800;" for="">Loaner Name: </label>
                        <label id="data_loaner"></label><br>
                        <label style="font-weight:800;" for="">Mobile: </label>
                        <label id="data_mobile"></label><br>
                        <label style="font-weight:800;" for="">Email: </label>
                        <label id="data_email"></label><br>
                         <label style="font-weight:800;" for="">Address: </label>
                        <label id="data_address"></label><br><br>
                    </div>
                </div>
                <button type="button" class="green-button mt-10" data-dismiss="modal"
                        style="padding: 5px 10px; color: #fff;" align="right">Cancel
                </button>
            </div>
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
    $('#l-view').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_loaner = button.data('loaner');
        var data_mobile = button.data('mobile');
        var data_email = button.data('email');
        var data_address = button.data('address');
        var modal = $(this);
        modal.find('.modal-body #data_loaner').html(data_loaner);
        modal.find('.modal-body #data_mobile').html(data_mobile);
        modal.find('.modal-body #data_email').html(data_email);
        modal.find('.modal-body #data_address').html(data_address);
    });
    $('#l-edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id');
        var data_loaner = button.data('loaner');
        var data_mobile = button.data('mobile');
        var data_email = button.data('email');
        var data_address = button.data('address');

        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id);
        modal.find('.modal-body #data_loaner').val(data_loaner);
        modal.find('.modal-body #data_mobile').val(data_mobile);
        modal.find('.modal-body #data_email').val(data_email);
        modal.find('.modal-body #data_address').val(data_address);
    });

    $(document).ready(function () {
        var table = $('#data').DataTable({
            responsive: true,
            dom: 'lBfrtip', processing: true, serverSide: true, "order": [[ 5, "desc" ]],
            ajax: "{{ route('loaner-getData') }}",
            columns: [
                {data:'loaner', name:'loaner'},
                {data:'mobile', name:'mobile'},
                {data:'email', name:'email'},
                {data:'address', name:'address'},
                {data:'option', name:'option'},
                {data:'created_at', name:'created_at', visible:false, searchable:false},
            ],
            "fnDrawCallback": function () {
                if ($("#TableAds").html()) {
                    var gnTr = document.createElement( 'tr' ); var nCell = document.createElement( 'td' );
                    nCell.colSpan = 6; nCell.align = 'center';nCell.innerHTML = $('#Ads').html();
                    gnTr.appendChild( nCell ); var nTrs = $('#data tbody tr');
                    nTrs[0].parentNode.insertBefore( gnTr, nTrs[0] );
                }
            },

            buttons: [
                {extend: 'copy', exportOptions: {columns: [0, 1, 2, 3]}},
                {extend: 'csv', exportOptions: {columns: [0, 1, 2, 3]}},
                {extend: 'excel', exportOptions: {columns: [0, 1, 2, 3]}},
                {extend: 'pdf', exportOptions: {columns: [0, 1, 2, 3]}},
                {extend: 'print', exportOptions: {columns: [0, 1, 2, 3]}}
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
