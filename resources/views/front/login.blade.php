@extends('layout.front.masterpage')
@section('title', 'Login')
@section('front_masterpage')

    <style>
        html, body{
            height:100%;
            margin:0;
            padding:0;
    }
    body {
        background-color: #F9F9F9;
    }
    </style>
    <div class="login-page-container">
        <div class="login-verical-alig">
{{--            <a href="{{route('home')}}"><h2 class="text-center"><img src="{!! asset('public/company/images/logo.jpg') !!}" height="80px" width="100px"></h2></a>--}}
            <a href="{{route('home')}}"><h2 class="text-center"><img src="{!! asset('company/images/logo.jpg') !!}" height="80px" width="100px"></h2></a>
            <h2 class="text-center">Sozashop</h2>
            <small><p class="text-center">Sign in to Sozashop</p></small>
            <div class="login-area mb-4">
                <form action="{{route('verify')}}" method="post" role="form">
                @csrf
                <label for="">Email address </label>
                <input type="text" id="email" name="email" class="form-control mb-3" placeholder="enter email....">
                <label for="">Password</label>
                <input type="password" id="password" name="password" class="form-control mb-4" placeholder="enter password....">
                <label for="" style="float: right;font-size: 15px;"><a href="{{route('password-reset')}}">Forgot Password?</a></label>
                <button type="submit" class="btn btn-primary form-control">Sign in</button>
                </form>
            </div>
            <div class="create-account-area"> New to Sozashop? <a href="{{route('register')}}">Create an account. </a> </div>
        </div>
    </div>
    @endsection
