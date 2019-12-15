@extends('layout.front.masterpage')
@section('title', 'Password Reset Code')
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
        <h2 class="text-center">New Password Set</h2>
        <small><h6 class="text-center">Give new password</h6></small>
        <div class="login-area mb-4" style="width: 120%">
            <form action="{{route('password-code-send')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-5">
                        <label for="">New Password</label><br><br>
                        <label for="">Confirm Password</label><br><br>

                    </div>
                    <input type="hidden" name="nmbr" value="{{$token}}">
                    <div class="col-sm-7">
                        <input type="password" name="password" id="password" class="form-control mb-3" placeholder="new password...." required>
                        <input type="password" name="confirm_password" id="conf_password" class="form-control mb-3" placeholder="confirm password...." required>
                        <small id="error_password"></small>
                        <small id="message"></small>
                    </div>
                     <br>
                </div>
                <button type="submit" id="register" class="btn btn-success btn-sm">Submit</button>
            </form>
        </div>
    </div>
</div>

@include('custom_plugin.validation')
@endsection
