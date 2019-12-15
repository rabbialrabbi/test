@extends('layout.company.masterpage')
@section('title', 'Add Company')
@section('masterpage')
@if(in_array('customer', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Add Company</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Add Company</a>
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
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Add Company</h2>
                            <small>use this form to add company to database.</small>
                            <div class="add-expense-area mt-5">
                                <div class="row">
                                    <div class="col-md-8">
                                        <form action="{{route('proCompany-add')}}" method="post">
                                            @csrf
                                            <label for="">Company</label><br>
                                            <input type="text" class="form-control mb-3" name="company" placeholder="Company Name" required>
                                            <label for="">Mobile</label><br>
                                            <input type="text" class="form-control mb-3" name="phone" placeholder="01800000000" >
                                            <label for="">Email</label><br>
                                            <input type="email" class="form-control mb-3" name="email" placeholder="example@email.com" >
                                            <label for="">Billing Address</label><br>
                                            <input type="text" class="form-control mb-3" name="billing" placeholder="Address" >
                                            <label for="">Due Balance</label><br>
                                            <input type="number" class="form-control mb-3" name="due" placeholder="Optional" >
                                            <input type="submit" class="btn btn-success mt-2" value="Add Company">
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
    </div>
</div>
@include('custom_plugin.js_files')
@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection
