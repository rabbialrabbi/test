@extends('layout.company.masterpage')
@section('title', 'Add Product')
@section('masterpage')
@if(in_array('product', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Add Product</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Add Product</a>
                    </div>
                </div>
                @if($ads1->status == 'on')
                <div class="col-md-8" id="Ads">
                    {!! html_entity_decode($ads1->code)!!}
                </div>
                <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                @endif
            </div>
            <div class="row new-sales-table-bg">
                <div class="col-md-12">
                    <h2>Add Product</h2>
                    <p>Use this form to add product to data base</p>
                    <div class="product-form">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{route('product-add')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                <small style="color:green;"> Do'nt use [{(!:,#%&~`+_-)}] </small>
                                <input type="text" name="product_name" placeholder="Name" class="form-control" required>

                                <select name="product_category" onchange="getData(this);" class="form-control" required>
                                    <option value="">Select Category</option>
                                     <option value="no" style="color: green;font-weight: bold;">Add Category</option>
                                    @foreach($shows as $show)
                                    <option value="{{$show->category}}">{{$show->category}}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="store_in" placeholder="Store In" class="form-control">
                                <input type="text" name="batch" placeholder="Batch No" class="form-control" required>
                                <input type="text" name="purchase_rate" id="purchaseAmount" placeholder="Purchase Rate" class="form-control" required>
                                <input type="text" name="selling_rate" placeholder="Selling Rate" class="form-control" required>

                                    <input type="text" name="qty"  id="qty" placeholder="Quantity" class="form-control" required>
                                    <label><h5>Purchase Informaion</h5></label>
                                    <input type="text" name="totalAmount" id="totalAmount" placeholder="Sub Total" class="form-control" readonly>
                                <input type="text" name="payment"  id="paymentA" placeholder="Payment" class="form-control">
                                <input type="text" name="totalDue" id="totalDue" placeholder="Total Due" class="form-control" readonly>
                                    <select name="unit"  class="form-control" required>
                                        <option value="">Select Unit</option>
                                        @foreach($units as $unit)
                                        <option value="{{$unit->currency}}">{{$unit->currency}}</option>
                                        @endforeach
                                    </select>
                                <select name="product_company" onchange="getCompanyDate(this);" class="form-control" required>
                                    <option value="">Select Company</option>
                                    <option value="company" style="color: green;font-weight: bold;">Add Company</option>
                                    @foreach($companies as $show)
                                        <option value="{{$show->id}}">{{$show->company}}</option>
                                    @endforeach
                                </select>
                                <div class="row">


                                    <div class="col-md-6">
                                        <h6>Mfg Date</h6>
                                        <input type="date" name="mfg_date" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Exp Date </h6>
                                        <input type="date" name="exp_date" class="form-control" required>
                                    </div>
                                </div>
                                <textarea name="details" cols="30" rows="5" class="form-control" placeholder="Details Upto 300 Character"></textarea>
                                <button type="submit" class="green-button" style="padding: 5px 10px; color: #fff;"> Submit </button>
                                </form>
                            </div>
                            <div class="col-md-4">
                                @if($ads2->status == 'on')
                                {!! html_entity_decode($ads2->code)!!}
                                <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Category -->
<div class="modal fade" id="cat-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus margin-right-css"></i>
                    Add Product Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="product-add-form">
                    <form action="{{route('pc-add')}}" method="post">
                        @csrf
                        <label for="">Category</label><br>
                        <input type="text" name="category" required><br>
                        <label for="">Description</label><br>
                        <textarea name="description" id="" cols="30" rows="3"></textarea>
                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Company -->
<div class="modal fade" id="company-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus margin-right-css"></i>
                    Add Company</h5>
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
@include('custom_plugin.js_files')
<script>
    function getData(sel) {
        if (sel.value === 'no') {
                $('#cat-add').modal('show');
                sel.value = '';
        }
    }
    // Add company
    function getCompanyDate(sel)
    {
        if(sel.value === 'company')
        {
            $('#company-add').modal('show');
            sel.value ='';
        }
    }

    // Calculation Total Amount
    var $amount = $('#purchaseAmount');
    var $qty = $('#qty');
    var $payment = $('#paymentA');
    var $total = $('#totalAmount');
    var $totalDue = $('#totalDue');
    function calcAmount()
    {
        var price = $amount.val();
        var unit  = $qty.val();
        var payment = $payment.val();
        var resultTotal = parseFloat(price) * parseFloat(unit);
        var totalamountDue = parseFloat(resultTotal) - parseFloat(payment);

        if(!isNaN(resultTotal))
        {
            $total.val(resultTotal);
            $totalDue.val(totalamountDue);
        }
        else{
            $total.val(price);
            $totalDue.val(price);
        }
    }
    calcAmount();
    $amount.on("keydown keyup",function(){
        calcAmount();
    });
    $qty.on("keydown keyup",function(){
        calcAmount();
    });
    $payment.on("keydown keyup",function(){
        calcAmount();
    });
    //
</script>
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection
