@extends('layout.front.masterpage')
@section('title', 'Contact')
@section('front_masterpage')
<style>
    html, body {
        height: inherit;
    }
    .header-area {
        height: inherit;
    }
    #map {
        width: 100%;
    }
</style>

<div class="header-area" style="border-bottom: 3px solid #e90e6994; margin-bottom: 50px;">
    @include('layout.front.header')
</div>

<div class="contact-us-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Contact Us</h2><br>
            </div>
        </div>
        <div class="contact-us-form" style="margin-bottom:30px;">
            <form action="{{route('send-contact')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <input type="text" name="user_name" placeholder="Full Name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <input type="text" name="shopname" placeholder="Shop Name" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <input type="email" name="email" placeholder="Email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="mobile" placeholder="Phone Number" class="form-control" required>
                    </div>
                    <div class="col-md-12 mt-4 mb-4">
                        <textarea name="msg" id="" cols="30" rows="5" class="form-control" placeholder="Details"></textarea>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary green-button" style="padding: 5px 20px; font-size: 20px">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<br><br>

@include('layout.front.footer')
@endsection
