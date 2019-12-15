@extends('layout.front.masterpage')
@section('title', 'Sozashop | Best Free Inventory Management Software Solutions. Save time Save money')
@section('front_masterpage')

    <div class="header-area">
        @include('layout.front.header')
        <!-- This part for online uploads -->
{{--        <div class="sign-up-section" style="background-image: url({{ URL::asset('public/cms_panel/'.$cms_header->image) }});">--}}
        <div class="sign-up-section" style="background-image: url({{ URL::asset('cms_panel/'.$cms_header->image) }});">
            <div class="container" style="position: relative; z-index: 10;">
                <div class="row">
                    <div class="col-md-7">
                        <div class="left-signup-section-text">
                            <h2>{{$cms_header->title}}</h2>
                            <p>{!! html_entity_decode($cms_header->description)!!}</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="right-signup-section">
                            <form method="POST" action="{{ route('registration') }}">
                                @csrf
                                <label for="">Shop Name</label>
                                <input type="text" name="shopname" placeholder="Pick a Shop Name..." class="form-control" required>
                                <input type="hidden" id="role" name="role"
                                       value="sales,product,stock,expired,expense,stuff,customer,loan,report,setting">
                                <input type="hidden" name="type" value="shop">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="" class="mt-1">First Name</label>
                                            <input type="text" id="fname" name="fname" placeholder="Owner's First Name...." class="form-control" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="" class="mt-1">Last Name</label>
                                            <input type="text" id="lname" name="lname" placeholder="Owner's Last Name...." class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                 <label for="">Phone Number</label>
                                <input type="text" id="mobile" name="mobile" placeholder="Owner's Phone Number...." class="form-control" required>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="" class="mt-1">Industry</label>
                                            <select name="industry"  id="industry" class="form-control" required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                <option value="{{$category->currency}}">{{$category->currency}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="" class="mt-1">Country</label>
                                            <select name="country"  id="country" class="form-control" required>
                                                <option value="">Select Country</option>
                                                @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->country}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <label for="">Email</label>
                                <input type="email" id="email" name="email" placeholder="you@example.com" class="form-control mb-2" required>
                                <span id="error_email"></span>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="" class=" mt-3">Password</label>
                                            <input id="password" type="password" name="password" placeholder="Create a password" class="form-control mb-2" required>
                                            <small id='error_password'></small>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="" class=" mt-3">Confirm Password</label>
                                            <input id="conf_password" type="password" name="confirm_password" placeholder="Confirm password" class="form-control mb-2" required>
                                            <small id='message'></small>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="register" class="btn btn-primary form-control mb-2 mt-2">Signup for Sozashop</button>
                                <small>By clicking “Sign up for Shop”, you agree to our terms of service and privacy statement.</small>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center pt-5 pb-5">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>Why Sozashop for Your Business?</h2>
                <p>Sozashop offers Web & Mobile Application Based Solution to Manage Your Shop and Business.</p>
            </div>
        </div>
        <div class="row">
            @foreach($cms_boxes as $cms_box)
            <div class="col-md-4">
                <div class="single-service-block">
                    <div class="icon_block mb-3"><img style="height: 80px; width: 88px;" src="{{asset('public/cms_panel/'.$cms_box->image)}}" alt=""></div>
                    <div class="service_info">
                        <h3 class="mb-3">{{$cms_box->title}}</h3>
                        <p>{!! html_entity_decode($cms_box->description)!!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="shop-review-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="left-how-work">
                        <h2>How Our Shop is Working?</h2>
                        <p>{!! html_entity_decode($cms_end->description) !!}</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="right-shop-video">
                        <iframe width="100%" height="400px" src="{{$cms_end->title}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layout.front.footer')
@include('custom_plugin.validation')

@endsection
