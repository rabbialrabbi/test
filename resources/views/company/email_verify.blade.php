@extends('layout.front.masterpage')
@section('title', 'Confirmation')
@section('front_masterpage')

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        background-color: #F9F9F9;
    }
</style>

<div class="login-page-container">
    <div class="login-verical-alig">
         <h3 class="text-center">Thank You For Successful Registration in Sozashop</h3>
        <div class="login-area mb-4">
            <a type="button" href="{{ route('login') }}" class="btn btn-primary form-control mb-2 mt-2">Login</a>
        </div>
    </div>
</div>
@endsection
