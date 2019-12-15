<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Error </title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('company/css/home-page.css')}}">
    <link rel="stylesheet" href="{{asset('company/css/bootstrap.min.css')}}">
    <!--toastr-->
    <script type="text/javascript" src="{{asset('custom/jquery.min.js')}}"></script>
    <link href="{{asset('custom/toastr.min.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('custom/toastr.min.js')}}"></script>

    <style>
        html, body{
            height:100%;
            margin:0;
            padding:0;
        }
        body {
            background-color: white;
        }
    </style>
</head>
<body>
@include('custom_plugin.toastr')
<div class="login-page-container">
    <div class="login-verical-alig">
        <h2 class="text-center">Shoza Shop</h2>
        <small style="color: red;"><h4 class="text-center">This ID is temporary blocked !</h4>
            <h5 class="text-center">Contact with Super Admin as soon as possible!</h5>
        </small>
        <b>Block reason:</b>
        @foreach($data as $key => $dt)
        <p>{{$key+1}}. {{$dt->msg}}</p>
        @endforeach
        <div class="create-account-area">
            <a href="{{route('home')}}"> <i class="fa fa-home"></i> Home </a>
            <a href="{{route('login')}}" class="float-right"> <i class="fa fa-user"></i> Login </a>
        </div>
        <div class="create-account-area">
            <button type="button" class="btn btn-info text-center" data-toggle="modal" data-target="#message">
                <i class="fa fa-envelope"></i>  Send message to Admin </button>
        </div>
    </div>
</div>

<div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-envelope margin-right-css"></i>
                    Send Message To Admin Authority</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="product-add-form">
                    <form action="{{route('message-to-admin')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <textarea name="msg" cols="30" rows="5" class="form-control"
                                  placeholder="write text here...." required></textarea> <br>
                        <!--<input type="file" name="document" class="form-control mb-2">-->
                        <!--<small> If required, send files</small><br><br>-->
                        <input type="hidden" name="ring" value="{{$user->ring}}">
                        <input type="hidden" name="shopname" value="{{$user->shopname}}">
                        <input type="hidden" name="fname" value="{{$user->fname}}">
                        <input type="hidden" name="lname" value="{{$user->lname}}">

                        <button type="submit" class="btn btn-success mt-2" width="20px;"> Submit</button>
                        <button type="button" class="btn btn-info mt-2" data-dismiss="modal">Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('custom_plugin.js_files')
</body>
</html>
