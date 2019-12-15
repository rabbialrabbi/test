@extends('layout.company.masterpage')
@section('title', 'Statement Generate')
@section('masterpage')
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Product Statement List</h2><a href="#">Dashboard</a><a href="#">Statement list</a>
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
            @isset($product_id)
            <input type="hidden" name="product_id" id="product_id" value="{{$product_id}}">
            @endisset
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
                                <table id="data" class="table table-bordered table-striped table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="align-middle" align="center">Product Name</th>
                                            <th class="align-middle" align="center">Status</th>
                                            <th class="align-middle" align="center">Quantity</th>
                                            <th class="align-middle" align="center">Present Quantity</th>
                                            <th class="align-middle" align="center">Return Reason</th>
                                            <th class="align-middle" align="center"> Date</th>
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
            </div>
        </div>
    </div>
</div>

<!--<div class="modal fade" id="delete_statement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"-->
<!--     aria-hidden="true">-->
<!--    <div class="modal-dialog" role="document">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fas fa-trash margin-right-css"></i>-->
<!--                    Delete Confirmation</h5>-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                    <span aria-hidden="true">&times;</span>-->
<!--                </button>-->
<!--            </div>-->
<!--            <form action="" method="post">-->
<!--                @csrf-->
<!--                <div class="modal-body">-->
<!--                    <div class="product-add-form">-->
<!--                        <h6> Are you sure you want to delete this? </h6>-->
<!--                    </div>-->
<!--                    <input type="hidden" name="id" id="data_id" value="">-->
<!--                    <input type="hidden" name="product_id" id="data_product_id" value="">-->
<!--                    <input type="hidden" name="name" id="data_name" value="">-->
<!--                </div>-->
<!--                <div class="modal-footer">-->
<!--                    <button type="submit" class="red-button mt-3" style="padding: 5px 10px; color: #fff;"><i-->
<!--                            class="fa fa-trash"></i> Delete-->
<!--                    </button>-->
<!--                    <button type="button" class="green-button mt-3" data-dismiss="modal"-->
<!--                            style="padding: 5px 10px; color: #fff;">Cancel-->
<!--                    </button>-->
<!--                </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

@include('custom_plugin.js_files')
<script type="text/javascript">
    $('#delete_statement').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.data('id'); var data_product_id = button.data('product_id'); var data_name = button.data('name');
        var modal = $(this);
        modal.find('.modal-body #data_id').val(data_id); modal.find('.modal-body #data_product_id').val(data_product_id); modal.find('.modal-body #data_name').val(data_name);
    });
    $(document).ready(function () {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        var table = $('#data').DataTable({
            responsive: true,

            dom: 'lBfrtip', processing: true, serverSide: true, "order": [[ 5, "desc" ]],
            ajax: {
                url: "{{ route('statement-getData') }}",
                type: 'GET',
                data: function (d) {
                    d.product_id = $('#product_id').val();
                }
            },
            columns: [
                {data:'product_name', name:'product_name'},
                {data:'status', name:'status'},
                {data:'qty', name:'qty', searchable:false},
                {data:'current_qty', name:'current_qty', searchable:false},
                {data:'reason', name:'reason', searchable:false},
                {data:'date', name:'date', searchable:false},
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
                { extend: 'copy', exportOptions: { columns: [0, 1, 2, 3, 4] } },
                { extend: 'csv', exportOptions: { columns: [0, 1, 2, 3, 4] } },
                { extend: 'excel', exportOptions: { columns: [0, 1, 2, 3, 4] } },
                { extend: 'pdf', exportOptions: { columns: [0, 1, 2, 3, 4] } },
                { extend: 'print', exportOptions: { columns: [0, 1, 2, 3, 4] } }
              ]
        });
        new $.fn.dataTable.FixedHeader( table );
    });
    $('#product_id').click(function(){ $('#data').DataTable().draw(true); });
</script>
@include('custom_plugin.datatable_files')
@endsection
