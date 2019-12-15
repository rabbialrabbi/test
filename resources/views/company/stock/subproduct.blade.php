@extends('layout.company.masterpage')
@section('title', 'Statement Generate')
@section('masterpage')
@if(in_array('stock', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Subproduct List</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Subproduct list</a>
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
                            <h2>Product Name: {{$name}}</h2><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="customer-table table-responsive">
                                <table id="data" class="table table-bordered table-striped table-hover"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="align-middle" align="center">Batch No</th>
                                        <th class="align-middle" align="center">Store In</th>
                                        <th class="align-middle" align="center">Purchase Rate</th>
                                        <th class="align-middle" align="center">Selling Rate</th>
                                        <th class="align-middle" align="center">Quantity </th>
                                        <th class="align-middle" align="center">Mfg. Date</th>
                                        <th class="align-middle" align="center">Exp. Date</th>
                                        <th class="align-middle" align="center"> Option</th>
                                        <th style="display: none"> created at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shows as $show)
                                    <tr>
                                        <td class="align-middle" align="center">{{$show->batch}}</td>
                                        <td class="align-middle" align="center">{{$show->store_in}}</td>
                                        <td class="align-middle" align="center">{{$show->purchase_rate}}</td>
                                        <td class="align-middle" align="center">{{$show->selling_rate}}</td>
                                        <td class="align-middle" align="center">{{$show->qty}}</td>
                                        <td class="align-middle" align="center">{{$show->mfg_date}}</td>
                                        <td class="align-middle"  align="center">{{$show->exp_date}}</td>
                                        <td class="align-middle" align="center">
                                            <button type="button" class="new-customer-button green-button mb-1" data-id="{{$show->id}}"
                                                    data-name="{{$show->product_name}}" data-qty="{{$show->qty}}" data-toggle="modal" data-target="#add">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            <button type="button" class="new-customer-button green-button mb-1" data-id="{{$show->id}}"
                                                    data-name="{{$show->product_name}}" data-qty="{{$show->qty}}" data-toggle="modal" data-target="#return">
                                                <i class="fa fa-minus"></i>
                                            </button>

                                            <button type="button" class="new-customer-button green-button"
                                                    data-id="{{$show->id}}" data-quantity="{{$show->qty}}" data-batch_no="{{$show->batch}}"
                                                    data-purchase="{{$show->purchase_rate}}" data-selling="{{$show->selling_rate}}"
                                                    data-store="{{$show->store_in}}" data-mfg="{{$show->mfg_date}}" data-exp="{{$show->exp_date}}"
                                                    data-toggle="modal" data-target="#edit_subproduct"><i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="new-customer-button red-button" data-id="{{$show->id}}"
                                                    data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i>
                                            </button>
                                            <form method="post" action="{{route('statement')}}" target="_blank">@csrf
                                                <input type="hidden" name="id" value="{{$show->id}}" />
                                                <input type="hidden" name="name" value="{{$show->product_name}}" />
                                                <button type="submit" class="new-customer-button light-blue-button mb-1">Statement</button>
                                            </form>
                                        </td>
                                        <td style="display: none">{{$show->created_at}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
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
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"> Product Quantity Add </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('stock-return')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Quantity Add </label><br><br>
                        </div>
                        <div class="col-md-8">
                            <input type="hidden" name="id" id="data_id" value="">
                            <input type="hidden" name="name" id="data_name" value="">
                            <input type="hidden" name="quantity" id="data_qty" value="">
                            <input type="text" class="form-control" name="add" placeholder="add quantity to stock..." required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="new-customer-button" style="padding: 5px 10px; color: #fff;">
                        <i class="fa fa-plus"></i> Add
                    </button>
                    <button type="button" class="green-button" data-dismiss="modal"
                            style="padding: 5px 10px; color: #fff;">Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="return" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"> Product Quantity Return </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('stock-return')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Quantity Returned </label><br><br><label for="">Reason </label><br><br>
                        </div>
                        <div class="col-md-8">
                            <input type="hidden" name="id" id="data_id" value="">
                            <input type="hidden" name="name" id="data_name" value="">
                            <input type="hidden" name="quantity" id="data_qty" value="">
                            <input type="text" class="form-control" name="return" placeholder="return quantity to Supplier..." required><br>
                            <textarea class="form-control" name="reason" placeholder="return Reason..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="new-customer-button" style="padding: 5px 10px; color: #fff;">
                        <i class="fa fa-minus"></i> Return
                    </button>
                    <button type="button" class="green-button" data-dismiss="modal"
                            style="padding: 5px 10px; color: #fff;">Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_subproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    Edit Item Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('sp-update')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Batch No</label><br><br>
                            <label for="">Purchase Rate</label><br><br><label for="">Selling Rate</label><br><br>
                            <label for="">Store In</label><br><br><label for="">Mfg. Date</label><br><br>
                            <label for="">Exp. Date</label><br><br>
                        </div>
                        <div class="col-md-7">
                            <input type="hidden" name="id" id="data_id" value="">
                            <input type="hidden" class="form-control mb-3" name="quantity" id="data_quantity" value="" required>
                            <input type="text" class="form-control mb-3" name="batch_no" id="data_batch_no" value="" required>
                            <input type="text" class="form-control mb-3" name="purchase" id="data_purchase" value="" required>
                            <input type="text" class="form-control mb-3" name="selling" id="data_selling" value="" required>
                            <input type="text" class="form-control mb-3" name="store" id="data_store" value="">
                            <input type="date" class="form-control mb-3" name="mfg" id="data_mfg" value="" required>
                            <input type="date" class="form-control mb-3" name="exp" id="data_exp" value="" required>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('p-destroy')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="product-add-form">
                        <h6> Are you sure you want to delete this? </h6>
                    </div>
                    <input type="hidden" name="id" id="data_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="red-button mt-3" style="padding: 5px 10px; color: #fff;"><i class="fa fa-trash"></i> Delete </button>
                    <button type="button" class="green-button mt-3" data-dismiss="modal" style="padding: 5px 10px; color: #fff;">Cancel </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('custom_plugin.js_files')
<script type="text/javascript">
    $('#add').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); var data_id = button.data('id'); var data_name = button.data('name'); var data_qty = button.data('qty');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id); modal.find('.modal-body #data_name').val(data_name); modal.find('.modal-body #data_qty').val(data_qty);
    });
    $('#return').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); var data_id = button.data('id'); var data_name = button.data('name'); var data_qty = button.data('qty');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id); modal.find('.modal-body #data_name').val(data_name); modal.find('.modal-body #data_qty').val(data_qty);
    });
    $('#edit_subproduct').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id'); var data_quantity = button.data('quantity'); var data_batch_no = button.data('batch_no');
        var data_purchase = button.data('purchase'); var data_selling = button.data('selling'); var data_store = button.data('store');
        var data_mfg = button.data('mfg'); var data_exp = button.data('exp');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id); modal.find('.modal-body #data_quantity').val(data_quantity);
        modal.find('.modal-body #data_batch_no').val(data_batch_no); modal.find('.modal-body #data_purchase').val(data_purchase);
        modal.find('.modal-body #data_selling').val(data_selling); modal.find('.modal-body #data_store').val(data_store);
        modal.find('.modal-body #data_mfg').val(data_mfg); modal.find('.modal-body #data_exp').val(data_exp);
    });
    $(document).ready(function () {
        var table = $('#data').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            "order": [[ 8, "desc" ]],
            "fnDrawCallback": function () {
                if ($("#TableAds").html()) {
                    var gnTr = document.createElement( 'tr' ); var nCell = document.createElement( 'td' );
                    nCell.colSpan = 8; nCell.align = 'center';nCell.innerHTML = $('#Ads').html();
                    gnTr.appendChild( nCell ); var nTrs = $('#data tbody tr');
                    nTrs[0].parentNode.insertBefore( gnTr, nTrs[0] );
                }
            },
            buttons: [
                { extend: 'copy', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] } },
                { extend: 'csv', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] } },
                { extend: 'excel', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] } },
                { extend: 'pdf', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] } },
                { extend: 'print', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] } }
              ],
            "columnDefs": [{ "targets": [ 2, 3, 4, 5, 6, 7, 8], "searchable": false }]
        });
        new $.fn.dataTable.FixedHeader( table );
    });
</script>
@include('custom_plugin.datatable_files')
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection
