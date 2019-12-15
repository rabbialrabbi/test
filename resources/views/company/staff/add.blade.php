@extends('layout.company.masterpage')
@section('title', 'Add Staff')
@section('masterpage')
@if(in_array('stuff', explode(",", Session::get('loggedUser')['role']  )))
<div id="add-cls-col-12" class="col-sm-8 col-lg-10 col-md-9">
    <div class="row dashboard-right-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="bread-cumb-area">
                        <h2>Add Staff</h2>
                        <a href="#">Dashboard</a>
                        <a href="#">Add Staff</a>
                    </div>
                </div>
            </div>
            <div class="row new-sales-table-bg">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Add Staff Type</h2>
                            <small>use this form to add staff to database.</small>
                            <div class="add-expense-area mt-5">
                                <div class="row">
                                    <div class="col-md-2">
                                        <br>
                                       <br>
                                        <br>
                                       <br>
                                        <br><br>
                                        <br><br>
                                       
                                       
                                    </div>
                                    <div class="col-md-6">
                                        <form method="POST" action="{{ route('add-staff') }}">
                                            @csrf
                                            
                                            <input type="hidden" name="ring" value="{{ Session::get('loggedUser')['ring'] }}">
                                            <input type="hidden" name="type"
                                                   value="{{ Session::get('loggedUser')['type']}}(staff)">
                                            
                                            <input type="hidden" name="shopname" value="{{Session::get('loggedUser')['shopname']}}">    <input type="hidden" name="industry" value="{{ Session::get('loggedUser')['industry'] }}">
                                            <input type="hidden" name="postcode" value="{{ Session::get('loggedUser')['postcode']}}">
                                            <input type="hidden" name="country" value="{{Session::get('loggedUser')['country']}}">
                                            <label for="">First Name</label><br>
                                            <input type="text" name="fname" class="form-control mb-3" placeholder="First Name" required>
                                             <label for="">Last Name</label><br>
                                            <input type="text" name="lname" class="form-control mb-3" placeholder="Last Name" required>
                                            <label for=""> Mobile</label><br>
                                            <input type="text" name="mobile" class="form-control mb-3" placeholder="Mobile" required>
                                             <label for="">Email</label><br><br>

                                            <input type="email" id="email" name="email" class="form-control mb-3" placeholder="Email" required>
                                            <span id="error_email"></span><br>
                                            <label for="">Password</label><br>
                                            <input type="password" id="password" name="password" class="form-control mb-3" placeholder="Password" required>
                                            <span id="error_password"></span><br>
                                            <label for="">Confirm Password</label><br>
                                            <input type="password" id="conf_password" name="confirm_password" class="form-control mb-3"
                                                   placeholder="Confirm password" required>
                                            <span id='message'></span><br>
                                             <label for="">User Type</label><br>
                                            <select name="usertype" class="form-control mb-3" required>
                                                <option value="">Select User Type</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Salesman">Salesman</option>
                                                <option value="Accountant">Accountant</option>
                                            </select>
                                             <label for="">Access</label><br>
                                            <label for="sales">Sales</label>
                                            <input type="checkbox" name="role[]" value="sales" class="mr-3">
                                            <label for="product">Product</label>
                                            <input type="checkbox" name="role[]" value="product" class="mr-3">
                                            <label for="stock">Stock</label>
                                            <input type="checkbox" name="role[]" value="stock" class="mr-3">
                                            <label for="expired">Expired</label>
                                            <input type="checkbox" name="role[]" value="expired" class="mr-3">
                                            <label for="">Expense</label>
                                            <input type="checkbox" name="role[]" value="expense" class="mr-3">
                                            <!--<label for="order">Order</label>
                                            <input type="checkbox" name="role[]" value="order" class="mr-3">
                                            <label for="branch">Branch</label>
                                            <input type="checkbox" name="role[]" value="branch" class="mr-3">-->
                                            <label for="staff">Staff</label>
                                            <input type="checkbox" name="role[]" value="stuff" class="mr-3">
                                            <label for="customer">Customer</label>
                                            <input type="checkbox" name="role[]" value="customer" class="mr-3">
                                            <label for="loan">Loan</label>
                                            <input type="checkbox" name="role[]" value="loan" class="mr-3">
                                            <label for="report">Report</label>
                                            <input type="checkbox" name="role[]" value="report" class="mr-3">
                                            <label for="setting">Setting</label>
                                            <input type="checkbox" name="role[]" value="setting" class="mr-3"><br>
                                            <button type="submit" id="register" class="btn btn-success mt-2">Add Staff</button>
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
@include('custom_plugin.validation2')
@include('custom_plugin.js_files')

@else
<h3 style="color: red;">No Access Permission</h3>
@endif
@endsection
