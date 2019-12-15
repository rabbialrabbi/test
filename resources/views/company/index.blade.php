@extends('layout.company.masterpage')
@section('title', 'Dashboard')
@section('masterpage')
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="row col-md-12 text-right mb-9">
            @if($ads1->status == 'on')
                <div class="col-md-10" id="Ads">
                    {!! html_entity_decode($ads1->code)!!}
                <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                </div>
            @else
                <div class="col-md-10"></div>
            @endif
            <div class="col-md-1 btn-group product-inline-btn margin-right-css mb-1">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> All
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <?php $current = date('Y-m-d', strtotime('+1 days')); $current_date = date('Y-m-d'); ?>
                    <a href="{{route('dashboard')}}"><button class="dropdown-item" type="button"> ALL </button></a>
                    <form action="{{route('dashboard-search')}}" method="post">
                        @csrf
                        <input type="hidden" name="from" value="{{$current_date}}"><input type="hidden" name="to" value="{{$current}}"/>
                        <a><button class="dropdown-item" type="submit" id="btnSubmitSearch">Today</button></a>
                    </form>
                    <form action="{{route('dashboard-search')}}" method="post">
                        @csrf
                        <?php $seven = date('Y-m-d', strtotime('-6 days'));?>
                        <input type="hidden" name="from" value="{{$seven}}"><input type="hidden" name="to" value="{{$current}}"/>
                        <a><button class="dropdown-item" type="submit" id="btnSubmitSearch">7 Days</button></a>
                    </form>
                    <form action="{{route('dashboard-search')}}" method="post">
                        @csrf
                        <?php $one_month = date('Y-m-d', strtotime('-1 month')); ?>
                        <input type="hidden" name="from" value="{{$one_month}}"><input type="hidden" name="to" value="{{$current}}"/>
                        <a><button class="dropdown-item" type="submit" id="btnSubmitSearch">1 Month </button></a>
                    </form>
                    <form action="{{route('dashboard-search')}}" method="post">
                        @csrf
                        <?php $one_year = date('Y-m-d', strtotime('-1 year'));?>
                        <input type="hidden" name="from" value="{{$one_year}}"><input type="hidden" name="to" value="{{$current}}"/>
                        <a><button class="dropdown-item" type="submit" id="btnSubmitSearch">365 Days </button></a>
                    </form>
                </div>
            </div>
        </div>

        @isset($start_data)
            @isset($end_data)
                <input type="hidden" name="invoice" id="from" value="{{$start_data}}">
                <input type="hidden" name="invoice" id="to" value="{{$end_data}}">
            @endisset
        @endisset

        <div class="col-md-12">
            <div class="row">
                @if(in_array('sales', explode(",", Session::get('loggedUser')['role']  )))
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="single-revinew text-center">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="single-revinew-text"><p>{{$logo->currency}} <?php echo number_format($sum_due, 2, '.', ',');?>
                                    </p> <p>Total Receivable</p> </div>
                            </div>
                            <div class="col-md-3">
                                <div class="single-revinew-icon"> <i class="far fa-chart-bar"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="single-revinew-two text-center">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="single-revinew-text"> <p>{{$logo->currency}} <?php echo number_format($sum_paid, 2, '.', ',');?>
                                    </p> <p>Total Received Amount</p> </div>
                            </div>
                            <div class="col-md-3">
                                <div class="single-revinew-icon"> <i class="far fa-chart-bar"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="single-revinew-three text-center">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="single-revinew-text"> <p>{{$logo->currency}} <?php echo number_format($sum_discount, 2, '.', ',');?>
                                    </p> <p>Total Discount Given</p> </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-revinew-icon"> <i class="far fa-chart-bar"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(in_array('expense', explode(",", Session::get('loggedUser')['role']  )))
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="single-revinew-three text-center">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="single-revinew-text"> <p>{{$logo->currency}} <?php echo number_format($sum_expense, 2, '.', ',');?>
                                    </p> <p>Total Expense</p> </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-revinew-icon"> <i class="far fa-chart-bar"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(in_array('stock', explode(",", Session::get('loggedUser')['role']  )))
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="single-revinew-four text-center">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="single-revinew-text"> <p>{{$logo->currency}} <?php echo number_format($sum_product, 2, '.', ',');?>
                                    </p> <p>Stock Amount</p> </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-revinew-icon"> <i class="far fa-chart-bar"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if( Session::get('loggedUser')['usertype'] == 'Admin')
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="single-revinew text-center">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="single-revinew-text"> <p>{{$logo->currency}} <?php echo number_format($sum_revenue, 2, '.', ',');?>
                                    </p> <p>Total Revenue</p> </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-revinew-icon"> <i class="far fa-chart-bar"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="row">
                @if(in_array('sales', explode(",", Session::get('loggedUser')['role']  )))
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="single-sales-history text-center">
                        <a href="{{route('sales-manage')}}" style="text-decoration: none;color: inherit" class="row">
                            <div class="col-md-4">
                                <div class="single-sales-history-icon"><i class="fas fa-file-invoice"></i></div>
                            </div>
                            <div class="col-md-8">
                                <div class="single-sales-history-text">
                                    <div class="singl-sales-history-text-one">Total Sales</div> <div class="singl-sales-history-text-one">{{$sale}}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if(in_array('stuff', explode(",", Session::get('loggedUser')['role']  )))
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="single-sales-history text-center">
                        <a href="{{route('staff-manage')}}" style="text-decoration: none;color: inherit" class="row">
                            <div class="col-md-4">
                                <div class="single-sales-history-icon"> <i class="fas fa-user"></i> </div>
                            </div>
                            <div class="col-md-8">
                                <div class="single-sales-history-text">
                                    <div class="singl-sales-history-text-one">Total Staff</div> <div class="singl-sales-history-text-one">{{$staff}}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if(in_array('product', explode(",", Session::get('loggedUser')['role']  )))
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="single-sales-history text-center">
                        <a href="{{route('product-category')}}" style="text-decoration: none;color: inherit" class="row">
                            <div class="col-md-2">
                                <div class="single-sales-history-icon"><i class="fab fa-sellsy"></i></div>
                            </div>
                            <div class="col-md-10">
                                <div class="single-sales-history-text">
                                    <div class="singl-sales-history-text-one">Total Product Category</div> <div class="singl-sales-history-text-one">{{$product_category}}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if(in_array('stock', explode(",", Session::get('loggedUser')['role']  )))
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="single-sales-history text-center">
                        <a href="{{route('product-manage')}}" style="text-decoration: none;color: inherit" class="row">
                            <div class="col-md-4">
                                <div class="single-sales-history-icon"> <i class="fab fa-sellsy"></i> </div>
                            </div>
                            <div class="col-md-8">
                                <div class="single-sales-history-text">
                                    <div class="singl-sales-history-text-one">Product In Stock</div> <div class="singl-sales-history-text-one">{{$product}}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if(in_array('customer', explode(",", Session::get('loggedUser')['role']  )))
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="single-sales-history text-center">
                        <a href="{{route('customer-manage')}}" style="text-decoration: none;color: inherit" class="row">
                            <div class="col-md-4">
                                <div class="single-sales-history-icon"> <i class="fas fa-user"></i> </div>
                            </div>
                            <div class="col-md-8">
                                <div class="single-sales-history-text">
                                    <div class="singl-sales-history-text-one">Total Customer</div> <div class="singl-sales-history-text-one">{{$customer}}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if(in_array('expired', explode(",", Session::get('loggedUser')['role']  )))
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="single-sales-history text-center">
                        <a href="{{route('expire')}}" style="text-decoration: none;color: inherit" class="row">
                            <div class="col-md-4">
                                <div class="single-sales-history-icon"> <i class="fab fa-empire"></i> </div>
                            </div>
                            <div class="col-md-8">
                                <div class="single-sales-history-text">
                                    <div class="singl-sales-history-text-one">Expired Product</div> <div class="singl-sales-history-text-one">{{$exp_product}}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if(in_array('customer', explode(",", Session::get('loggedUser')['role']  )))
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="single-sales-history text-center">
                        <a href="{{route('sales-unpaid')}}" style="text-decoration: none;color: inherit" class="row">
                            <div class="col-md-4">
                                <div class="single-sales-history-icon"> <i class="fab fa-sellsy"></i> </div>
                            </div>
                            <div class="col-md-8">
                                <div class="single-sales-history-text">
                                    <div class="singl-sales-history-text-one">Credit Customer</div> <div class="singl-sales-history-text-one">{{$credit_customer}}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if(in_array('stock', explode(",", Session::get('loggedUser')['role']  )))
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="single-sales-history text-center">
                        <a href="{{route('stock-alert')}}" style="text-decoration: none;color: inherit" class="row">
                            <div class="col-md-4">
                                <div class="single-sales-history-icon"> <i class="fa fa-warehouse"></i> </div>
                            </div>
                            <div class="col-md-8">
                                <div class="single-sales-history-text">
                                    <div class="singl-sales-history-text-one">Stock Alert</div> <div class="singl-sales-history-text-one">{{$stock_alert}}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
            </div>
            @if($ads1->status == 'on')
            <div class="row">
                <div class="col-md-12" style="display: flex;justify-content: center;">
                    {!! html_entity_decode($ads1->code)!!}
                    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                </div>
            </div>
            @endif
            <div class="row dashboard-margin">
                <div class="col-md-3">
                    @if($ads2->status == 'on')
                    {!! html_entity_decode($ads2->code)!!}
                    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                    @endif
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <div class="row">
                                            <div class="col-sm-5 col-md-6">
                                                <h5 class="mb-0">
                                                    <button style="color:brown; font-weight: bold;" class="btn btn-link" type="button" data-toggle="collapse"
                                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Recent Sales
                                                    </button>
                                                </h5>
                                            </div>
                                            <div class="col-sm-7 col-md-6">
                                                <div class="card-icon">
                                                    <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                                       aria-controls="collapseOne"><i class="fas fa-angle-down"></i></a>
                                                    <a href="{{route('dashboard')}}"><i class="fas fa-sync-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                            <table id="data" class="table table-bordered dashboard-table-font-size">
                                                <thead>
                                                    <th scope="row">Sales Number</th> <th>Customer Name</th>
                                                    <th>Sales By</th><th>Paid Amount</th><th>Remaining Amount</th><th>Option</th>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('custom_plugin.js_files')
<script>
    $(document).ready(function () {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
       var table =  $('#data').DataTable({
        responsive: true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            dom: 'lBfrtip', processing: true, serverSide: true, "order": [[ 0, "desc" ]],
            ajax: {
                url: "{{ route('dashboard-getData') }}",
                type: 'GET',
                data: function (d) {
                    d.start_date = $('#from').val(); d.end_date = $('#to').val();
                   // console.log(d.start_date);
                  //  console.log(d.end_date);
                }
            },
            columns: [
                {data:'sales_no', name:'sales_no'},
                {data:'cus_name', name:'cus_name'},
                {data:'seller', name:'seller'},
                {data:'paid', name:'paid'},
                {data:'remaining', name:'remaining'},
                {data:'option', name:'option'},
            ],
            "fnDrawCallback": function () {
                if ($("#Ads").html()) {
                    var gnTr = document.createElement( 'tr' ); var nCell = document.createElement( 'td' );
                    nCell.colSpan = 6; nCell.align = 'center';nCell.innerHTML = $('#Ads').html();
                    gnTr.appendChild( nCell ); var nTrs = $('#data tbody tr');
                    nTrs[0].parentNode.insertBefore( gnTr, nTrs[0] );
                }
            },
             "bFilter": false,  buttons: [],
        });
        new $.fn.dataTable.FixedHeader( table );
    });
    $('#btnSubmitSearch').click(function(){ $('#data').DataTable().draw(true); });
</script>
@include('custom_plugin.datatable_files')
@endsection
