<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('company/images/logo.jpg') !!}">
    <link rel="stylesheet" href="{{asset('company/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('company/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('company/css/page.css')}}">
    <link rel="stylesheet" href="{{asset('company/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('company/css/responsive.css')}}">
    <script src="{{asset('company/js/full-screen.js')}}"></script>
    <!--toastr-->
    <script type="text/javascript" src="{{asset('custom/jquery.min.js')}}"></script>
    <link href="{{asset('custom/toastr.min.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('custom/toastr.min.js')}}"></script>


    <!-- data table design css
    <link rel="stylesheet" href="{{asset('datatable/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatable/css/jquery.dataTables.min.css')}}">

     -->





    <!--  ads -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <style>
        #myBtn {
            display: none; position: fixed; bottom: 20px; right: 20px; z-index: 99;
            font-size: 15px; border: none; outline: none; background-color: #007bff; color: white;
            cursor: pointer; padding: 15px; border-radius: 4px; content: ;
        }
        #myBtn:hover { background-color: #1a4993; }
        .dataTables_length{ margin-right: 40px; }
    </style>

    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140699834-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-140699834-1');
</script>

<meta name="google-site-verification" content="gcUrdzeR4Zs16fNd2OwtUSGdWfSumnO-8x5Px8RdZYM" />

<style>
 /*STARSTUFF STYLESHEET FOR MENU ON 575W*/


 .visible-sidebar .dbm-h{
    display:block!important;
}
	table{
		width: 98%!important;
}
	tr.child{
		width: 100%!important;
		text-align: left !important;
	}

table.dataTable.dtr-inline.collapsed > tbody > tr > td.child, table.dataTable.dtr-inline.collapsed > tbody > tr > th.child, table.dataTable.dtr-inline.collapsed > tbody > tr > td.dataTables_empty {

    cursor: default !important;
    text-align: left !important;

}


table tr button, table form button{
	margin: 0px 4px 4px 0 !important;
}
.ml-1, .mx-1 {
    margin-left: 0 !important;
}


.left-signup-section-text h2 {
    color: rgb(255, 255, 255);
    overflow-wrap: break-word;
}

.left-signup-section-text p {
    color: rgb(179, 179, 179);
    transition: .4s;
    word-wrap: break-word;
}

.sign-up-section::after{
    background-color: rgba(36, 55, 64, 0.67);
}

@media screen and (max-width: 768px) {

	.left-signup-section-text h2 {
    font-size: 44px;
}
	.row .col-sm-6{
	padding: 0px;
}
}



.btn-primary {
    background: linear-gradient(90deg, #971a6c, #780eb0);
    border:none !important;
    transition: 1s;
    font-family: 'Poppins', sans-serif;
}


.btn-primary:hover {
    background: linear-gradient(90deg, #dd4d89, #9914df);
    border:none !important;
}

.footer-area{
	background: #0a0920!important;
}

.footer-area-bottom{
	border-top: 2px solid #515151;
	background: #1e2144;
}

.footer-right-subscribe input[type="text"]{
	border-radius: 15px 0 0 15px;
	border: 1px solid #fff;
	background-color: #0a0920;
}

a:hover {
    color: #ec619b!important;
 }

 .dashboard-header {
    background: #0a0920 !important;
}

.shoza-shop-logo{
	color:#f2f2f2!important;
	text-align: left;
}

.star-stuff-toggle{
	position: absolute;
	top: 60px;
	left: 0;
	width: 120px;

}
.dashboard-right-content {
    padding-left: 5px !important;
    padding-right: 5px !important;
}
.star-stuff-toggle .star-stuff-menuIcon, .star-stuff-toggle .star-stuff-expand a{
	cursor: pointer!important;
	color: #b9b9b9 !important;
}
.star-stuff-toggle .star-stuff-menuIcon:hover, .star-stuff-toggle .star-stuff-expand:hover a{
	cursor: pointer!important;
	color:#fff!important;
}
.star-stuff-search input{
	text-align: center;
}
.dashboard-search input[type="text"] {

    background-color: #cacaca;
   }

 .dashboard-search input[type="text"] {
 	border-radius: 4px;
 }





@media screen and (max-width: 900px) {
	.star-stuff-search-start {
	width: 355px !important;
	position: absolute;
	top: 25px;
	left: 0;
	bottom:0;
	right:0;
	margin: auto;
	}
	.star-stuff-search-start .star-stuff-search input#star-stuff-input-id{


	}

.star-stuff-right-top-section {
    width: 100px;
    position: absolute;
    right: 0;
    bottom: 0;
    top: 19px;

}

.dashboard-header {

    padding: 22px 0 52px;
    border-bottom: 1px solid #d7d8dc;

}

}


@media screen and (max-width: 730px){
	.star-stuff-search-start {
    width: 355px !important;
    position: absolute;
    top: 64px;
    left: 5px;
    bottom: 0;
    right: 0;
    margin: auto;
}


}


@media screen and (max-width: 768px){

}
@media screen and (max-width: 510px){
	.dashboard-search input[type="text"] {

    border: none;
    padding: 5px;
    margin-left:-50px;
    height: 31px;
    width: 42%;
    font-size: 11px;

}
.star-stuff-search-icon{
	display: none!important;
}

.displayOpenForMenu{
	display: block!important;
}

}

.product-inline-btn {
    display: block;

}
        .menu-icon {
        display: initial!important;
    }
@media (min-width: 576px) {
        .menu-icon {
        display: initial!important;
    }


}
.star-stuff-mobile-responsive-table{
    display:none;
}
.new-customer-area label {

    display: block;
    margin-bottom: 5px!important;

}

.star-stuff-table-mobile-view{
    display:none;
}
.star-red{color:#f34336!important;}
.star-bg-red{background-color:#f34336!important;}
.star-green{color:#4ab066 !important}
.star-bg-green{background-color:#4ab066 !important}
.star-blue{color:#3e6fcb!important;}
.star-bg-blue{background-color:#3e6fcb!important;}
.star-yellow{color:#f59447!important;}
.star-bg-yellow{background-color:#f59447!important;}
.star-purple{color:#9b079bde !important}
.star-bg-purple{background-color:#9b079bde !important}
.star-gray{color:gray!important;}
.star-bg-gray{background-color:gray!important;}
.star-white{color:#ffffffed!important;}
.star-bg-white{background-color:#ffffffed!important;}
.star-margin-top-sm{margin-top:10px!important;}
.star-margin-top-md{margin-top:20px!important;}
.star-margin-top-lg{margin-top:30px!important;}
.star-margin-top-ex-lg{margin-top:40px!important;}
.star-top-bottom-padding{padding:20px 0!important;}
/* ============================= Max width 575px ============================== */
    @media (max-width: 575px) {
    .star-stuff-table-desktop-view, .star-stuff-td-hide{
    display:none;
}
    .star-stuff-table-mobile-view{
    display:initial;
}



        .menu-icon {
        display: initial!important;
    }
    .dashboard-left-side-menu-icon-one{
        display:none!important;
    }
   .visible-sidebar {
        display: block!important;
        position: absolute!important;
        top: 118px!important;
        width: 53%!important;
        z-index: 9999!important;
    }
    .star-stuff-desktop-responsive-table{
        display:none!important;
    }
    .star-stuff-mobile-responsive-table{
        display: inherit;
    }
   .star-stuff-mobile-responsive-table  table tr,  .star-stuff-mobile-responsive-table  table tr td,  .table th {
        padding: 6px 1px!important;
    }
    .star-stuff-mobile-responsive-table .star-td-width{
        width: 72PX;

    }
    .new-sales-d-inline{
        float:none;
        width: 100%;
    }
    button.star-stuff-btn-table {

    background-color: #28a745;
    border: 1px solid #28a745;
    color: #fff;
    cursor: pointer;
    padding: 4px 10px;
    border-radius: 5px;
    box-shadow: -2px 3px 0px #62bcd57a;
    transition:.1s;

}
button.star-stuff-btn-table:focus,button.star-stuff-btn-table:active{
    border: 1px solid transparent!important;
    outline: 1px solid transparent!important;
}
button.star-stuff-btn-table:hover {

    background-color: #089328;
    border: 1px solid #089328;
    box-shadow: 0px 0px 0px #94bcc87a;
    margin-top: 5px !important;
    margin-left: -1px !important;

}
.star-stuff-content-right{
    padding-left: 0px !important;
    padding-right: 0px !important;
}
.star-stuff-table-bg{
    padding: 20px 0!important;
}
.star-stuff-col-md{
    padding: 0 5px !important;
}
.star-stuff-submit-btn{
    margin: 10px 0 !important;
    font-size: 17px;
   background-color: #28a745!important;
    border: 1px solid #28a745!important;
    color: #fff;
    cursor: pointer;
    padding: 4px 10px;
    border-radius: 5px;
    box-shadow: -2px 3px 0px #62bcd57a;
    transition:.1s;
}
.star-stuff-submit-btn:hover{
    background-color: #089328!important;
    border: 1px solid #089328!important;
    box-shadow: 0px 0px 0px #94bcc87a!important;
    margin-left: -1px !important;

}
.star-stuff-modal-dialogue-full-screen{
    width: 97%!important;
}

lebel{
    overflow-wrap: break-word!important;
}

}
</style>
</head>
<body>
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class=" fa fa-arrow-up"></i></button>
@include('layout.company.header')
<div class="container-fluid">
    <div class="row right-bg">
        @include('custom_plugin.toastr')
        @include('layout.company.sidebar')
        @yield('masterpage')
    </div>
    @include('layout.company.footer')
</div>
<script>
    window.onscroll = function() {scrollFunction()}; /* scroll */
    document.getElementById("myBtn").style.transition = ".4s";
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) { document.getElementById("myBtn").style.display = "block"; }
        else { document.getElementById("myBtn").style.display = "none"; }
    }
    function topFunction() {
        document.body.scrollTop = 0; document.documentElement.scrollTop = 0;
    }
</script>
</body>
</html>
