@extends('layout.front.masterpage')
@section('title', 'Registration')
@section('front_masterpage')
<script src="{{asset('company/js/full-screen.js')}}"></script>
    <style>
        html, body { height: inherit; }
        .has-error { border-color:#cc0000; }
    </style>
    <div class="header-area">
        @include('layout.front.header')
    </div>
    <div class="sign-up-background">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="signup-form-area ml-3 mb-4">
                        <h2>Join Sozashop</h2>
                        <p>The best way to manage your business</p>
                        <h2 class="mb-2">Create your personal account </h2>
                        <div class="signup-form">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="shop-page-table-content table-responsive">
                                            <form method="POST" action="{{ route('registration') }}">
                                            @csrf
                                            <label for="">Shop Name</label>
                                            <input type="text" name="shopname" placeholder="Pick a Shop Name..." class="form-control" required>
                                            <input type="hidden" id="role" name="role"
                                            value="sales,product,stock,expired,expense,stuff,customer,loan,report,setting">
                                            <input type="hidden" name="type" value="shop">
                                                <!--<select name="type" class="form-control" required>
                                                    <option value="">Select Type</option>
                                                    <option value="shop">Shop</option><option value="company">Company</option>
                                                </select>-->
                                                <div class="col-md-12">
                                                    <div class="row">
                                            <div class="col-sm-6">
                                            <label for="" class="mt-3">First Name</label>
                                            <input type="text" id="fname" name="fname" placeholder="Owner's First Name...." class="form-control" required>
                                            </div>
                                                <div class="col-sm-6">
                                            <label for="" class="mt-3">Last Name</label>
                                            <input type="text" id="lname" name="lname" placeholder="Owner's Last Name...." class="form-control" required>
                                                </div>
                                                </div>
                                                </div>

                                            <label for="">Phone Number</label>
                                            <input type="text" id="mobile" name="mobile" placeholder="Owner's Phone Number...." class="form-control" required>
                                            <label for="">Industry</label>
                                            <select name="industry"  id="industry" class="form-control" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->currency}}">{{$category->currency}}</option>
                                            @endforeach
                                            </select>
                                            <label for="">Post Code</label>
                                            <input type="text" id="postcode" name="postcode" placeholder="Post Code...." class="form-control" required>
                                            <label for="">Country</label>
                                                <select name="country"  id="country" class="form-control" required>
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->country}}</option>
                                                    @endforeach
                                                </select>
                                            <label for="" class="mt-3">Email</label>
                                            <input type="text" id="email" name="email" placeholder="you@example.com" class="form-control mb-2" required>
                                                <span id="error_email"></span>
                                            <label for="" class=" mt-3">Password</label>
                                            <input id="password" type="password" name="password" placeholder="Create a password"
                                            class="form-control mb-2" required>
                                                <span id="error_password"></span>
                                                <label for="" class=" mt-3">Confirm Password</label>
                                                <input id="conf_password" type="password" name="confirm_password" placeholder="Confirm password"
                                                       class="form-control mb-2" required>
                                                <span id='message'></span>
                                            <button type="submit" id="register" class="btn btn-primary form-control mt-3 mb-3">Signup for Sozashop</button>
                                            <small>By clicking “Sign up for Shop”, you agree to our terms of service and privacy statement.</small>
                                        </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="offset-md-2 col-md-4">
                <div class="sign-up-right-side">
                    <div class="sign-up-right-side-box">
                        <div class="box-top-title">
                            <h2>You will Love Sozashop</h2>
                        </div>
                        <div class="box-middle-content">
                            <p>Unlimited Product</p> <p>Track your sale</p>
                        </div>
                        <div class="box-bottom-content">
                            <p> Unlimited Staff</p> <p>Know your balance</p> 
                            <marquee>
                                <h3 style="color:green">Life time free</h3>
                            </marquee>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.front.footer')
@include('custom_plugin.validation')
@endsection



