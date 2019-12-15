@extends('layout.company.masterpage')
@section('title', 'Product Company')
@section('masterpage')
@if(in_array('product', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Product Company</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Product Company</a>
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
                    <div class="row section-margin">
                        <div class="col-lg-4">
                            <div class="product-page-add-category">
                                <button type="button" class="product-page-add-cate-btn" data-toggle="modal" data-target="#exampleModal"><i
                                        class="fas fa-plus margin-right-css"></i>Create Product Company
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="customer-table table-responsive">
                                <table id="companyData" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Company</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Billing Address</th>
                                            <th>Due Balance</th>
                                            <th>Date</th>
                                            <th>Option</th>
                                            <th style="display: none">created a</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;"></tbody>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus margin-right-css"></i>
                    Add Product Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="product-add-form">
                    <form action="{{route('proCompany-add')}}" method="post">
                        @csrf
                        <label for="">Company</label><br>
                        <input type="text" class="form-control mb-3" name="company" id=""
                               required>
                        <label for="">Mobile</label><br>
                        <input type="text" class="form-control mb-3" name="phone" id=""
                        >
                        <label for="">Email</label><br>
                        <input type="text" class="form-control mb-3" name="email" id=""
                        >
                        <label for="">Billing Address</label><br>
                        <input type="text" class="form-control mb-3" name="billing" id=""
                        >
                        <label for="">Due Balance</label><br>
                        <input type="text" class="form-control mb-3" name="due" id=""
                        >
                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_proCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    Edit Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('proCompany-update')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-11">
                            <input type="hidden" name="id" id="data_id" value="">
                            <label for="">Company</label><br>
                            <input type="text" class="form-control mb-3" name="company" id="data_company"
                                   required>
                            <label for="">Mobile</label><br>
                            <input type="text" class="form-control mb-3" name="phone" id="data_phone"
                            >
                            <label for="">Email</label><br>
                            <input type="text" class="form-control mb-3" name="email" id="data_email"
                            >
                            <label for="">Billing Address</label><br>
                            <input type="text" class="form-control mb-3" name="billing" id="data_billing_address"
                                  >
                            <label for="">Due Balance</label><br>
                            <input type="text" class="form-control mb-3" name="due" id="data_due"
                            >
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
            <form action="{{route('proCompany-destroy')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="product-add-form">
                        <h6> Are you sure you want to delete this? </h6>
                    </div>
                    <input type="hidden" name="id" id="data_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="red-button mt-3" style="padding: 5px 10px; color: #fff;"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="green-button mt-3" data-dismiss="modal" style="padding: 5px 10px; color: #fff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('custom_plugin.js_files')
<script type="text/javascript">
    $('#edit_proCompany').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id');
        var data_company = button.data('company');
        var data_phone = button.data('phone');
        var data_email = button.data('email');
        var data_due = button.data('due');
        var data_billing = button.data('billing');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id);
        modal.find('.modal-body #data_company').val(data_company);
        modal.find('.modal-body #data_phone').val(data_phone);
        modal.find('.modal-body #data_email').val(data_email);
        modal.find('.modal-body #data_due').val(data_due);
        modal.find('.modal-body #data_billing_address').val(data_billing);
    });
    $(document).ready(function () {
       var table = $('#companyData').DataTable({
            responsive: true,
            dom: 'lBfrtip', processing: true, serverSide: true, "order": [[ 2, "desc" ]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            ajax: "{{ route('pc-companyGetData') }}",
            columns: [
                {data:'company', name:'company'},
                {data:'company_phone', name:'company_phone'},
                {data:'company_email', name:'company_email'},
                {data:'billing_address', name:'billing_address', searchable:false},
                {data:'due_balance', name:'due_balance'},
                {data:'date', name:'date'},
                {data:'option', name:'option', searchable:false},
            ],
            "fnDrawCallback": function () {
                if ($("#TableAds").html()) {
                    var gnTr = document.createElement( 'tr' );var nCell = document.createElement( 'td' );
                    nCell.colSpan = 4; nCell.align = 'center';nCell.innerHTML = $('#Ads').html();gnTr.appendChild( nCell );
                    var nTrs = $('#companyData tbody tr');nTrs[0].parentNode.insertBefore( gnTr, nTrs[0] );
                }
            },
            buttons: [
                {extend: 'copy', exportOptions: {columns: [0, 1, 2]}},
                {extend: 'csv', exportOptions: {columns: [0, 1, 2]}},
                {extend: 'excel', exportOptions: {columns: [0, 1, 2]}},
                {extend: 'pdf', exportOptions: {columns: [0, 1, 2]}},
                {extend: 'print', exportOptions: {columns: [0, 1, 2]}},
            ]
        }); new $.fn.dataTable.FixedHeader( table );
    });
</script>
@include('custom_plugin.datatable_files')
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection
