<!-- Add public/ at all file -->
<script type="text/javascript" src="{{asset('company/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('company/js/all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('company/js/main.js')}}"></script>
<script type="text/javascript" src="{{asset('company/js/bootstrap.min.js')}}"></script>





<!-- Starstuff CSS-->
<link rel="stylesheet" href="{{asset('starStuff/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('starStuff/css/fixedHeader.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('starStuff/css/responsive.dataTables.min.css')}}">

<!-- Starstuff JS-->
<!--<script type="text/javascript" src="{{asset('starStuff/js/jquery-3.3.1.js')}}"></script>-->
<script type="text/javascript" src="{{asset('starStuff/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('starStuff/js/dataTables.fixedHeader.min.js')}}"></script>
<script type="text/javascript" src="{{asset('starStuff/js/dataTables.responsive.min.js')}}"></script>


<script>
    if(window.screen.width <= 575){
    $(".dashboard-left-side-menu").hide();
    $(".dashboard-left-side-menu-icon-one").hide();
    $(".dashboard-left-side-menu").css({"position":"absolute","top":"116px","width":"58%","z-index":"9999"});

    $(".star-stuff-menuIcon").click(function(){

          $(".dashboard-left-side-menu").toggleClass("visible-sidebar");



    });
}
</script>


<style>

</style>
