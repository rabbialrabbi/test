@extends('layout.company.masterpage')
@section('title', 'Manage Customers')
@section('masterpage')
@if(in_array('customer', explode(",", Session::get('loggedUser')['role']  )))
<style>
    .nav-item {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }
    .nav-link {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        transition: 0.3s;
    }
    .nav-link:hover {
        background-color: #ddd;
    }
</style>
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Customer List</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Customer list</a>
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
                            <h2>Exporting Customer Data</h2>
                        </div>
                    </div>
                    <div class="shop-page-content">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#support" role="tab" aria-controls="contact" aria-selected="false">Manage Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#support-reply" role="tab" aria-controls="contact" aria-selected="false">Sale Info</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="support" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="customer-table table-responsive">
                                            <table id="data" class="table table-bordered table-striped table-hover" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th class="align-middle" align="center">Customer Name</th>
                                                    <th class="align-middle" align="center">Mobile</th>
                                                    <th class="align-middle" align="center">Email</th>
                                                    <th class="align-middle" align="center">Billing Address</th>
                                                    <!--                                        <th class="align-middle" align="center">Total Invoice</th>-->
                                                    <!--                                        <th class="align-middle" align="center">Total Amount</th>-->
                                                    <!--                                        <th class="align-middle" align="center">Paid Amount</th>-->
                                                    <!--                                        <th class="align-middle" align="center">Remaining Amount</th>-->
                                                    <th class="align-middle" align="center"> Option</th>
                                                    <th style="display: none">created at</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                            <br>
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
                            <div class="tab-pane fade" id="support-reply" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="customer-table table-responsive">
                                            <table id="data2" class="table table-bordered table-striped table-hover" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th class="align-middle" align="center">Customer Name</th>
                                                    <th class="align-middle" align="center">Mobile</th>
                                                    <th class="align-middle" align="center">Total Invoice</th>
                                                    <th class="align-middle" align="center">Total Amount</th>
                                                    <th class="align-middle" align="center">Paid Amount</th>
                                                    <th class="align-middle" align="center">Remaining Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="align-middle" align="center"></td> <td class="align-middle" align="center"></td>
                                                        <td class="align-middle" align="center"></td> <td class="align-middle" align="center"></td>
                                                        <td class="align-middle" align="center"></td> <td class="align-middle" align="center"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <br>
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
        </div>
    </div>
</div>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    Edit Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('cm-update')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-11">
                            <input type="hidden" name="id" id="data_id" value="">
                            <label for="">Customer Name</label><br>
                            <input type="text" class="form-control mb-3" name="name" id="data_name" value="" required>
                            <label for="">Mobile</label><br>
                            <input type="text" class="form-control mb-3" name="mobile" id="data_mobile" value="">
                            <label for="">Email</label><br>
                            <input type="text" class="form-control mb-3" name="email" id="data_email" value="">
                            <label for="">Billing Address</label><br>
                            <input type="text" class="form-control mb-3" name="address" id="data_address" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="new-customer-button mt-3" style="padding: 5px 10px; color: #fff;"><i class="fa fa-edit"></i> Update</button>
                    <button type="button" class="green-button mt-3" data-dismiss="modal" style="padding: 5px 10px; color: #fff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    Customer Detail Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="product-add-form">
                    <h6><strong> Detail Information </strong></h6>
                </div>
                <div class="row">

                    <div class="col-md-8">
                       <label style="font-weight:800;" for="">Customer Name: </label><label id="data_name"></label><br>
                       <label style="font-weight:800;" for="">Mobile: </label><label id="data_mobile"></label><br>
                         <label style="font-weight:800;" for="">Email: </label><label id="data_email"></label><br> 
                         <label style="font-weight:800;" for="">Billing Address: </label><label id="data_address"></label><br><br>
                    </div>
                </div>
                <button type="button" class="green-button mt-10" data-dismiss="modal" style="padding: 5px 10px; color: #fff;" align="right">Cancel</button>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('cm-destroy')}}" method="post">
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
    $('#view').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_name = button.data('name'); var data_mobile = button.data('mobile');
        var data_email = button.data('email'); var data_address = button.data('address');
        var modal = $(this);
        modal.find('.modal-body #data_name').html(data_name); modal.find('.modal-body #data_mobile').html(data_mobile);
        modal.find('.modal-body #data_email').html(data_email); modal.find('.modal-body #data_address').html(data_address);
    });
    $('#edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id'); var data_name = button.data('name'); var data_mobile = button.data('mobile');
        var data_email = button.data('email'); var data_address = button.data('address');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id); modal.find('.modal-body #data_name').val(data_name);
        modal.find('.modal-body #data_mobile').val(data_mobile); modal.find('.modal-body #data_email').val(data_email);
        modal.find('.modal-body #data_address').val(data_address);
    });
    $(document).ready(function () {
        var table = $('#data').DataTable({
            responsive: true,
            dom: 'lBfrtip', processing: true, serverSide: true, "order": [[ 5, "desc" ]],
            ajax: "{{ route('customer-getData') }}",
            columns: [
                {data:'name', name:'name'},
                {data:'mobile', name:'mobile'},
                {data:'email', name:'email'},
                {data:'address', name:'address', searchable:false},
                {data:'option', name:'option', searchable:false},
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
                { extend: 'copy', exportOptions: { columns: [0, 1, 2, 3] } },
                { extend: 'csv', exportOptions: { columns: [0, 1, 2, 3] } },
                { extend: 'excel', exportOptions: { columns: [0, 1, 2, 3] } },
                { extend: 'pdf', exportOptions: { columns: [0, 1, 2, 3] } },
                { extend: 'print', exportOptions: { columns: [0, 1, 2, 3] } }
              ]
        });
        //new $.fn.dataTable.FixedHeader( table );
         var tableData = $('#data2').DataTable({
            responsive: true,
            dom: 'lBfrtip', processing: true, serverSide: true, "order": [[ 5, "desc" ]],
            ajax: "{{ route('customer-invoice-getData') }}",
            columns: [
                {data:'cus_name', name:'cus_name'},
                {data:'cus_mobile', name:'cus_mobile'},
                {data:'inv_no', name:'inv_no', searchable:false},
                {data:'grand_total', name:'grand_total', searchable:false},
                {data:'paid', name:'paid', searchable:false},
                {data:'due', name:'due', searchable:false},
            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(); nb_cols = api.columns().nodes().length; var j = 2;
                while(j < nb_cols){
                    var pageTotal = api.column( j, { page: 'current'} ).data().reduce( function (a, b) {
                            return Number(a) + Number(b); }, 0 );
                    $( api.column( j ).footer() ).html('Total: ' + pageTotal.toFixed(2)); j++;
                }
            },
            buttons: [
                { extend: 'copy', exportOptions: { columns: [0, 1, 2, 3, 4] } },
                { extend: 'csv', exportOptions: { columns: [0, 1, 2, 3, 4] } },
                { extend: 'excel', exportOptions: { columns: [0, 1, 2, 3, 4] } },
                { extend: 'pdf', exportOptions: { columns: [0, 1, 2, 3, 4] } },
                { extend: 'print', exportOptions: { columns: [0, 1, 2, 3, 4] } }
            ]
        });

        new $.fn.dataTable.FixedHeader( table);
        new $.fn.dataTable.FixedHeader( tableData );
    });
</script>
@include('custom_plugin.datatable_files')
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection
