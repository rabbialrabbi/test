<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('company/images/logo.jpg') !!}">
    <link rel="stylesheet" href="{{asset('company/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('company/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('company/css/page.css')}}">
    <link rel="stylesheet" href="{{asset('company/cms_style.css')}}">
    <link rel="stylesheet" href="{{asset('company/css/responsive.css')}}">
    <!--toastr-->
    <script type="text/javascript" src="{{asset('custom/jquery.min.js')}}"></script>
    <link href="{{asset('custom/toastr.min.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('custom/toastr.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
</head>
<style>
    .modal-lg {
        max-width: 55% !important;
    }
</style>
<body>
@include('custom_plugin.toastr')
<div class="container-fluid">
    <div class="row right-bg">
        <div class="col-lg-2 col-md-3 dashboard-left-side-menu">
            <div class="row">
                <div class="col-md-12">
                    <div class="logo">
                        <img src="{{asset('cms_panel/logo1.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a class="no-underline" href="{{route('cms')}}">
                        <div class="dashboard">
                            <i class="fas fa-home"></i>
                            <h4>Contect Management</h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="dashboard-menu">
                        <nav>
                            <ul>
                                <li><a class="mainmenu" href="{{route('cms')}}"><i class="fas fa-globe margin-right-css"></i> CMS</a></li>
                                <li><a  class="mainmenu"href="{{route('cms-blog')}}"> <i class="fas fa-edit margin-right-css"></i> Blog</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1 col-lg-1 dashboard-left-side-menu-icon-one">
            <div class="row">
                <div class="col-md-12">
                    <a class="no-underline" href="{{route('cms')}}">
                        <div class="dashboard">
                            <i class="fas fa-home"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="dashboard-menu text-center">
                        <nav>
                            <ul>
                                <li><a class="mainmenu" href="{{route('cms')}}"><i class="fas fa-globe"></i></a></li>
                                <li><a  class="mainmenu" href="{{route('cms-blog')}}"> <i class="fas fa-edit"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!--     left side Menu and logo section end-->
        <!--         right side start-->
        <div id="add-cls-col-12" class="col-lg-10 col-md-9">
            <!--             header start-->
            <div class="row dashboard-header text-center">
                <div class="col-12 col-sm col-md-2">
                    <div class="menu-icon">
                        <i class="fas fa-align-justify"></i>
                    </div>
                </div>
                <div class="col-12 col-sm col-md-6">
                    <div class="dashboard-search">
                        <form action="">
                            <i class="fas fa-search"></i>
                            <input type="search" placeholder="SEARCH">
                        </form>
                    </div>
                </div>
                <div class="col-12 offset-md-3 col-sm col-md-1">
                    <div class="dashboard-user">

                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{route('cms-password')}}" class="dropdown-item" style="background-color: inherit;">Change Password</a>
                                <a href="{{route('logout-cms')}}" class="dropdown-item">Signout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--    header end-->
            @yield('cms')
        </div>
    </div>
    <!--      footer area-->
    <div class="row text-center">
        <div class="col-md-12">
            <div class="footer">
                Copyright &copy; 2019
            </div>
        </div>
    </div>
</div>
</body>
</html>
