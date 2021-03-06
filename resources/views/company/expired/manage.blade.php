@extends('layout.company.masterpage')
@section('title', 'Expired')
@section('masterpage')
@if(in_array('expired', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Expire Alert</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Expire</a>
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
                        <div class="col-md-5">
                            <h2>Exporting Product Data</h2>
                        </div>
                        <div class="col-lg-7">
                            <div class="product-category-search">
                                <label>From</label>
                                <input class="input-search-product" name="froms" id="froms" type="date">
                                <label>To</label>
                                <input class="input-search-product" name="tos" id="tos" type="date">
                                <button type="text" id="btnSubmitSearch" class="btn btn-info btn-sm">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="customer-table table-responsive">
                                <table id="data" class="table table-bordered table-striped
                                table-hover product-page-table-font-size">
                                    <thead>
                                    <tr>
                                        <td>Name</td> <td>Category</td> <td>Store In</td> <td>Batch No</td>
                                        <td>Purchase Rate</td> <td>Selling Rate</td> <td>Quantity</td>
                                        <td>Company</td>  <td>Mfg. Date</td> <td>Exp. Date</td>
                                        <td>Option</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
<!--                                    <tfoot>-->
<!--                                    <tr>-->
<!--                                        <td class="align-middle" align="center"></td>-->
<!--                                        <td class="align-middle" align="center"></td>-->
<!--                                        <td class="align-middle" align="center"></td>-->
<!--                                        <td class="align-middle" align="center"></td>-->
<!--                                        <td class="align-middle" align="center"></td>-->
<!--                                        <td class="align-middle" align="center"></td>-->
<!--                                        <td class="align-middle" align="center"></td>-->
<!--                                        <td class="align-middle" align="center"></td>-->
<!--                                        <td class="align-middle" align="center"></td>-->
<!--                                        <td class="align-middle" align="center"></td>-->
<!--                                        <td class="align-middle" align="center"></td>-->
<!--                                    </tr>-->
<!--                                    </tfoot>-->
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
                                                    <?php echo number_format($purchase, 2, '.', ',');?></h5>
                                                <p>Purchase Rate</p>
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
                                                    <?php echo number_format($sell, 2, '.', ',');?></h5>
                                                <p>Selling Rate</p>
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
                                            <div class="single-revinew-text"> <h5>
                                                    <?php echo number_format($qty, 2, '.', ',');?></h5>
                                                <p>Quantity</p>
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

<div class="modal fade" id="edit_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    Edit Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <form action="{{route('p-update')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!--<div class="col-md-4">-->
                        <!--    <label for="">Name</label><br><br><label for="">Category</label><br><br>-->
                        <!--    <label for="">Store In</label><br><br><label for="">Batch No</label><br><br>-->
                        <!--    <label for="">Purchase Rate</label><br><br><label for="">Selling Rate</label><br><br>-->
                        <!--    <label for="">Company</label><br><br><label for="">Mfg. Date</label><br><br>-->
                        <!--    <label for="">Exp. Date</label><br><br><label for="">Details</label><br><br>-->
                        <!--</div>-->
                        <!--<div class="col-md-7">-->
                        <!--    <input type="hidden" name="id" id="data_id" value="">-->
                        <!--    <input type="text" class="form-control mb-3" name="product_name" id="data_product_name" value="" required>-->
                        <!--    <input type="text" class="form-control mb-3" name="product_category" id="data_product_category" value="" required>-->
                        <!--    <input type="text" class="form-control mb-3" name="store_in" id="data_store_in" value="">-->
                        <!--    <input type="text" class="form-control mb-3" name="batch" id="data_batch" value="" required>-->
                        <!--    <input type="text" class="form-control mb-3" name="purchase_rate" id="data_purchase_rate" value="" required>-->
                        <!--    <input type="text" class="form-control mb-4" name="selling_rate" id="data_selling_rate" value="" required>-->
                        <!--    <input type="text" class="form-control mb-3" name="company" id="data_company" value="">-->
                        <!--    <input type="date" class="form-control mb-3" name="mfg_date" id="data_mfg_date" value="" required>-->
                        <!--    <input type="date" class="form-control mb-3" name="exp_date" id="data_exp_date" value="" required>-->
                        <!--    <input type="text" class="form-control mb-3" name="details" id="data_details" value="">-->
                        <!--</div>-->
                        
                         <div class="col-md-11">
                            <input type="hidden" name="id" id="data_id" value="">
                            <label for="">Name</label><br>
                            <input type="text" class="form-control mb-3" name="product_name" id="data_product_name" value="" required>
                            <label for="">Category</label><br>
                            <input type="text" class="form-control mb-3" name="product_category" id="data_product_category" value="" required>
                            <label for="">Store In</label><br>
                            <input type="text" class="form-control mb-3" name="store_in" id="data_store_in" value="" required>
                            <label for="">Batch No</label><br>
                            <input type="text" class="form-control mb-3" name="batch" id="data_batch" value="" required>
                            <label for="">Purchase Rate</label><br>
                            <input type="text" class="form-control mb-3" name="purchase_rate" id="data_purchase_rate" value="" required>
                            <label for="">Selling Rate</label><br>
                            <input type="text" class="form-control mb-3" name="selling_rate" id="data_selling_rate" value="" required>
                            
                            <input type="hidden" class="form-control mb-3" name="qty" id="data_qty" value="" required>
                             <label for="">Company</label><br>
                            <input type="text" class="form-control mb-3" name="company" id="data_company" value="">
                            <label for="">Mfg. Date</label><br>
                            <input type="date" class="form-control mb-3" name="mfg_date" id="data_mfg_date" value="" required>
                            <label for="">Exp. Date</label><br>
                            <input type="date" class="form-control mb-3" name="exp_date" id="data_exp_date" value="" required>
                            <label for="">Details</label><br>
                            <input type="text" class="form-control mb-3" name="details" id="data_details" value="">
                        </div> 
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="new-customer-button mt-3" style="padding: 5px 10px; color: #fff;"><i class="fa fa-edit"></i> Update </button>
                    <button type="button" class="green-button mt-3" data-dismiss="modal" style="padding: 5px 10px; color: #fff;"> Cancel </button>
                </div>
            </form>
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
                    <button type="submit" class="new-customer-button" style="padding: 5px 10px; color: #fff;"> <i class="fa fa-plus"></i> Add </button>
                    <button type="button" class="green-button" data-dismiss="modal" style="padding: 5px 10px; color: #fff;">Cancel </button>
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
                        

                        <div class="col-md-8">
                            <input type="hidden" name="id" id="data_id" value="">
                            <input type="hidden" name="name" id="data_name" value="">
                            <input type="hidden" name="quantity" id="data_qty" value="">
                            <label for="">Quantity Returned </label>
                            <input type="text" class="form-control" name="return" placeholder="return quantity to Supplier..." required><br>
                            <label for="">Reason </label>
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
<div class="modal fade" id="view_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">d
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-edit margin-right-css"></i>
                    Customer Detail Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>

            <div class="modal-body">
                <div class="product-add-form"> <h6><strong> Detail Information </strong></h6> </div>
                <div class="row">
                    
                    
                    
                    
                    
                    
 
                    <div class="col-md-8">
                         <label style="font-weight:800;" for="">Name: </label>
                        <label id="data_product_name"></label><br>
                        <label style="font-weight:800;" for="">Category: </label>
                        <label id="data_product_category"></label><br>
                        <label style="font-weight:800;" for="">Store In: </label>
                        <label id="data_store_in"></label><br>
                        <label style="font-weight:800;" for="">Batch No: </label>
                        <label id="data_batch"></label><br>
                        <label style="font-weight:800;" for="">Purchase Rate: </label>
                        <label id="data_purchase_rate"></label><br>
                        <label style="font-weight:800;" for="">Selling Rate: </label>
                        <label id="data_selling_rate"></label><br>
                         <label style="font-weight:800;" for="">Quantity: </label>
                        <label id="data_qty"></label><br>
                        <label style="font-weight:800;" for="">Company: </label>
                        @if(Session::get('loggedUser')['industry'] == 'Pharmacy')<label id="data_generic_name"></label><br> @endif
                        <label id="data_company"></label><br>
                         
                        @if(Session::get('loggedUser')['industry'] == 'Pharmacy')<label id="data_effects"></label><br>@endif
                        <label style="font-weight:800;" for="">Mfg. Date: </label>
                        <label id="data_mfg_date"></label><br>
                        <label style="font-weight:800;" for="">Exp. Date: </label>
                        <label id="data_exp_date"></label><br>
                        <label style="font-weight:800;" for="">Details: </label>
                        <label id="data_details"></label><br>
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
                    <button type="button" class="green-button mt-3" data-dismiss="modal" style="padding: 5px 10px; color: #fff;"> Cancel </button>
                </div>
        </div>
    </div>
</div>
@include('custom_plugin.js_files')

<script type="text/javascript">
    $('#view_product').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_product_name = button.data('product_name'); var data_product_category = button.data('product_category');
        var data_store_in = button.data('store_in'); var data_qty = button.data('qty'); var data_batch = button.data('batch');
        var data_purchase_rate = button.data('purchase_rate'); var data_selling_rate = button.data('selling_rate');
        var data_company = button.data('company'); var data_mfg_date = button.data('mfg_date');
        var data_exp_date = button.data('exp_date'); var data_details = button.data('details');
        var modal = $(this);
        modal.find('.modal-body #data_product_name').html(data_product_name); modal.find('.modal-body #data_product_category').html(data_product_category);
        modal.find('.modal-body #data_store_in').html(data_store_in); modal.find('.modal-body #data_batch').html(data_batch);
        modal.find('.modal-body #data_purchase_rate').html(data_purchase_rate); modal.find('.modal-body #data_selling_rate').html(data_selling_rate);
        modal.find('.modal-body #data_qty').html(data_qty);modal.find('.modal-body #data_company').html(data_company);
        modal.find('.modal-body #data_mfg_date').html(data_mfg_date); modal.find('.modal-body #data_exp_date').html(data_exp_date);
        modal.find('.modal-body #data_details').html(data_details);
    });
    $('#edit_product').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id'); var data_product_name = button.data('product_name'); var data_product_category = button.data('product_category');
        var data_store_in = button.data('store_in'); var data_batch = button.data('batch'); var data_purchase_rate = button.data('purchase_rate');
        var data_selling_rate = button.data('selling_rate'); var data_company = button.data('company'); var data_mfg_date = button.data('mfg_date');
        var data_exp_date = button.data('exp_date'); var data_details = button.data('details');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id); modal.find('.modal-body #data_product_name').val(data_product_name);
        modal.find('.modal-body #data_product_category').val(data_product_category); modal.find('.modal-body #data_store_in').val(data_store_in);
        modal.find('.modal-body #data_batch').val(data_batch); modal.find('.modal-body #data_purchase_rate').val(data_purchase_rate);
        modal.find('.modal-body #data_selling_rate').val(data_selling_rate);
        modal.find('.modal-body #data_company').val(data_company); modal.find('.modal-body #data_mfg_date').val(data_mfg_date);
        modal.find('.modal-body #data_exp_date').val(data_exp_date); modal.find('.modal-body #data_details').val(data_details);
    });
    $('#add').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id'); var data_name = button.data('name'); var data_qty = button.data('qty');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id); modal.find('.modal-body #data_name').val(data_name); modal.find('.modal-body #data_qty').val(data_qty);
    });
    $('#return').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id'); var data_name = button.data('name'); var data_qty = button.data('qty');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id); modal.find('.modal-body #data_name').val(data_name); modal.find('.modal-body #data_qty').val(data_qty);
    });
    $(document).ready(function () {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        var table = $('#data').DataTable({
            responsive: true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            dom: 'lBfrtip', processing: true, serverSide: true, "order": [[ 9, "desc" ]],
            ajax: {
                url: "{{ route('expire-getData') }}",
                type: 'GET',
                data: function (d) {
                    d.start_date = $('#froms').val(); d.end_date = $('#tos').val();
                }
            },
            columns: [
                {data:'product_name', name:'product_name'},
                {data:'product_category', name:'product_category'},
                {data:'store_in', name:'store_in', searchable:false},
                {data:'batch', name:'batch', searchable:false},
                {data:'purchase_rate', name:'purchase_rate', searchable:false},
                {data:'selling_rate', name:'selling_rate', searchable:false},
                {data:'qty', name:'qty', searchable:false},
                {data:'company', name:'company'},
                {data:'mfg_date', name:'mfg_date', searchable:false},
                {data:'expire', name:'expire', searchable:false},
                {data:'option', name:'option', orderable:false, searchable:false},
            ],
            // "footerCallback": function ( row, data, start, end, display ) {
            //     var api = this.api(); nb_cols = api.columns().nodes().length; var j = 4;
            //     while(j < nb_cols && j < 7){
            //         var pageTotal = api.column( j, { page: 'current'} ).data().reduce( function (a, b) {
            //                 return Number(a) + Number(b); }, 0 );
            //         $( api.column( j ).footer() ).html('Total: ' + pageTotal.toFixed(2)); j++;
            //     }
            // },
            "fnDrawCallback": function () {
                if ($("#TableAds").html()) {
                    var gnTr = document.createElement( 'tr' ); var nCell = document.createElement( 'td' );
                    nCell.colSpan = 11; nCell.align = 'center'; nCell.innerHTML = $('#Ads').html();
                    gnTr.appendChild( nCell ); var nTrs = $('#data tbody tr');
                    nTrs[0].parentNode.insertBefore( gnTr, nTrs[0] );
                }
            },
            buttons: [
                {extend: 'copy', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}},
                {extend: 'csv', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}},
                {extend: 'excel', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}},
                {extend: 'pdf', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}},
                {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}}
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
