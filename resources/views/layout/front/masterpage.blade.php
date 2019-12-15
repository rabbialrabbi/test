<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>

      <meta name="description" content="Sozashop is a free online inventory management system for small and medium sized businesses. Sozashop are built to give small business owners time back. Sozashop offers Web & Mobile Application Based Solution to Manage Your Shop and Business">
  <meta name="keywords" content="Inventory Management Software, Free Inventory Management Software, Small Business Inventory">


    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('company/images/logo.jpg') !!}">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('company/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('company/css/page.css')}}">
    <link rel="stylesheet" href="{{asset('company/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('company/css/home-page.css')}}">
    <link rel="stylesheet" href="{{asset('company/css/home-responsive.css')}}">
    <link rel="stylesheet" href="{{asset('company/css/bootstrap.min.css')}}">
    <script src="{{asset('company/js/full-screen.js')}}"></script>
    <!--toastr-->
    <script type="text/javascript" src="{{asset('custom/jquery.min.js')}}"></script>
    <link href="{{asset('custom/toastr.min.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('custom/toastr.min.js')}}"></script>


    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140699834-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-140699834-1');
</script>

<meta name="google-site-verification" content="gcUrdzeR4Zs16fNd2OwtUSGdWfSumnO-8x5Px8RdZYM" />


</head>
<style>
    .modal-lg {
        max-width: 60% !important;
    }
</style>
<body>
@include('custom_plugin.toastr')
@yield('front_masterpage')

@include('custom_plugin.js_files')
<script type="text/javascript" src="{{asset('custom/jquery.min.js')}}"></script>
</body>
</html>
