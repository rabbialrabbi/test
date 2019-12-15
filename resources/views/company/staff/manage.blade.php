@extends('layout.company.masterpage')
@section('title', 'Manage Staff')
@section('masterpage')
@if(in_array('stuff', explode(",", Session::get('loggedUser')['role']  )))
<style>
    .role{
        color: black;
        font-weight: bold;
        font-size: 14px;
    }
</style>
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Staff List</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Staff list</a>
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
                            <h2>Exporting Staff Data</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="customer-table table-responsive">
                                <table id="data" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th class="align-middle" align="center">Full Name</th>
                                        <th class="align-middle" align="center">Mobile</th>
                                        <th class="align-middle" align="center">User Type/Position</th>
                                        <th class="align-middle" align="center">Access</th>
                                        <th class="align-middle" align="center">Option</th>
                                        <th style="display: none">created at</th>
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

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    Edit Staff Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('staff-update')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <input type="hidden" name="id" id="data_id" value="">
                            <label for="">First Name</label><br>
                            <input type="text" class="form-control mb-3" name="fname" id="data_fname" value="" required>
                            <label for="">Last Name</label><br>
                            <input type="text" class="form-control mb-3" name="lname" id="data_lname" value="" required>
                            <label for="">Mobile</label><br>
                            <input type="text" class="form-control mb-3" name="mobile" id="data_mobile" value="" required>
                            <label for="">Email</label><br>
                            <input type="email" class="form-control mb-3" name="email" id="data_email" value="" required>
                             <label for="">Password</label><br>
                            <input type="password" class="form-control mb-3" name="password" placeholder="enter new password ....">
                            <label for="">User type</label><br>
                            <select name="usertype" class="form-control mb-3" required>
                                <option value="">Select User Type</option>
                                <option value="Admin">Admin</option>
                                <option value="Salesman">Salesman</option>
                                <option value="Accountant">Accountant</option>
                            </select>
                            <label for="">Role</label><br>
                            <label for="sales">Sales</label> <input type="checkbox" name="role[]" value="sales" class="mr-3">
                            <label for="product">Product</label> <input type="checkbox" name="role[]" value="product" class="mr-3">
                            <label for="stock">Stock</label> <input type="checkbox" name="role[]" value="stock" class="mr-3"> <br>
                            <label for="expired">Expired</label> <input type="checkbox" name="role[]" value="expired" class="mr-3">
                            <label for="">Expense</label> <input type="checkbox" name="role[]" value="expense" class="mr-3">
                            <!--<label for="order">Order</label><input type="checkbox" name="role[]" value="order" class="mr-3">
                            <label for="branch">Branch</label><input type="checkbox" name="role[]" value="branch" class="mr-3">-->
                            <label for="staff">Stuff</label> <input type="checkbox" name="role[]" value="stuff" class="mr-3"><br>
                            <label for="customer">Customer</label> <input type="checkbox" name="role[]" value="customer" class="mr-3">
                            <label for="loan">Loan</label> <input type="checkbox" name="role[]" value="loan" class="mr-3">
                            <label for="report">Report</label> <input type="checkbox" name="role[]" value="report" class="mr-3"><br>
                            <label for="setting">Setting</label> <input type="checkbox" name="role[]" value="setting" class="mr-3"><br>
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

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-trash margin-right-css"></i>
                    Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('staff-destroy')}}" method="post">
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
    $('#edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id');
        var data_fname = button.data('fname');
        var data_lname = button.data('lname');
        var data_mobile = button.data('mobile');
        var data_email = button.data('email');
        var data_usertype = button.data('usertype');
        var data_role = button.data('role');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id);
        modal.find('.modal-body #data_fname').val(data_fname);
        modal.find('.modal-body #data_lname').val(data_lname);
        modal.find('.modal-body #data_mobile').val(data_mobile);
        modal.find('.modal-body #data_email').val(data_email);
        modal.find('.modal-body #data_usertype').val(data_usertype);
        modal.find('.modal-body #data_role').val(data_role);
    });

    $(document).ready(function () {
        var table = $('#data').DataTable({
            responsive: true,

            dom: 'lBfrtip', processing: true, serverSide: true, "order": [[ 5, "desc" ]],
            ajax: "{{ route('staff-getData') }}",
            columns: [
                {data:'name', name:'name'},
                {data:'mobile', name:'mobile'},
                {data:'usertype', name:'usertype'},
                {data:'role', name:'role', searchable:false},
                {data:'option', name:'option'},
                {data:'created_at', name:'created_at', visible:false, searchable:false},
            ],
            "fnDrawCallback": function () {
                if ($("#TableAds").html()) {
                    var gnTr = document.createElement( 'tr' ); var nCell = document.createElement( 'td' );
                    nCell.colSpan = 7; nCell.align = 'center';nCell.innerHTML = $('#Ads').html();
                    gnTr.appendChild( nCell ); var nTrs = $('#data tbody tr');
                    nTrs[0].parentNode.insertBefore( gnTr, nTrs[0] );
                }
            },
            buttons: [
                {extend: 'copy', exportOptions: {columns: [0, 1, 2, 3, 4]}},
                {extend: 'csv', exportOptions: {columns: [0, 1, 2, 3, 4]}},
                {extend: 'excel', exportOptions: {columns: [0, 1, 2, 3, 4]}},
                {extend: 'pdf', exportOptions: {columns: [0, 1, 2, 3, 4]}},
                {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4]}},
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
