@extends('layout.front.masterpage')
@section('title', 'Password Reset')
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
        <h2 class="text-center">Password Reset </h2>
        <small><h6 class="text-center">Give <b>Registered</b> Email Address for getting <br>Password Reset Code</h6></small>
        <div class="login-area mb-4">
            <form action="{{route('password-reset-mail')}}" method="post">
                @csrf
                <input type="text" name="email" class="form-control mb-4" placeholder="enter email address...." required>
                <a type="button" href="{{url('/login')}}" class="btn btn-primary btn-sm">Back</a>&nbsp;
                <button type="submit" class="btn btn-success btn-sm">Submit</button>
            </form>
        </div>
         <label for="" style="color: green;">After Submit, Please Check Email Inbox/ Spam Folder & Click On Password Reset Link for Reset Password</label>
    </div>
</div>
@endsection
