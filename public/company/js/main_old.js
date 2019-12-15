$(document).ready(function(){

    $(".delete-button").click(function(){
        $(".new-sales-row-tr").remove();
    });
    $("body").on("click",".delete-button",function(e){
        $(this).parents('.new-sales-row-tr').remove();
    });
    
    
    
/*
  $(".menu-icon").click(function(){
    $(".dashboard-left-side-menu").toggle();
    $("#add-cls-col-12").toggleClass("col-lg-11");
    $("#add-cls-col-12").toggleClass("col-md-10");
    $("#add-cls-col-12").toggleClass("col-sm-10");
    $(".dashboard-left-side-menu-icon-one").toggle();
  });
  
*/
if(window.screen.width <= 575){
     $(".dashboard-left-side-menu").hide();
    $(".dashboard-left-side-menu-icon-one").hide();
  
    $(".menu-icon").click(function(){
         
          $(".dashboard-left-side-menu").toggle();
    });
    
}else{
    $(".menu-icon").click(function(){
    $(".dashboard-left-side-menu").toggle();
    $("#add-cls-col-12").toggleClass("col-lg-11");
    $("#add-cls-col-12").toggleClass("col-md-10");
    $("#add-cls-col-12").toggleClass("col-sm-10");
    $(".dashboard-left-side-menu-icon-one").toggle();
  });
}

  
  
  

  $(".position-relative-box").click(function(){
    $(".position-absolute-class-picker").addClass("position-absolute-check");
    $(".position-absolute-check").css("display", "block");
  });

  $(".open-full-screen").click(function(){
    $(".close-full-screen").css("display", "block");
      $(this).css("display", "none");
  });

  $(".close-full-screen").click(function(){
    $(".open-full-screen").css("display", "block");
      $(this).css("display", "none");
  });

  $(".icon-show-hide-one").click(function(){
    $(".menu-icon-show").toggleClass("fa-angle-down fa-angle-right" );
  });

  $(".icon-show-hide-two").click(function(){
    $(".menu-icon-show-two").toggleClass("fa-angle-down fa-angle-right" );
  });

  $(".icon-show-hide-three").click(function(){
    $(".menu-icon-show-three").toggleClass("fa-angle-down fa-angle-right" );
  });

  $(".icon-show-hide-four").click(function(){
    $(".menu-icon-show-four").toggleClass("fa-angle-down fa-angle-right" );
  });

  $(".icon-show-hide-five").click(function(){
    $(".menu-icon-show-five").toggleClass("fa-angle-down fa-angle-right" );
  });

  $(".icon-show-hide-six").click(function(){
    $(".menu-icon-show-six").toggleClass("fa-angle-down fa-angle-right" );
  });

  $(".icon-show-hide-seven").click(function(){
    $(".menu-icon-show-seven").toggleClass("fa-angle-down fa-angle-right" );
  });

  $(".icon-show-hide-eight").click(function(){
    $(".menu-icon-show-eight").toggleClass("fa-angle-down fa-angle-right" );
  });

  $(".icon-show-hide-nine").click(function(){
    $(".menu-icon-show-nine").toggleClass("fa-angle-down fa-angle-right" );
  });

  $(".icon-show-hide-ten").click(function(){
    $(".menu-icon-show-ten").toggleClass("fa-angle-down fa-angle-right" );
  });

  $(".icon-show-hide-eleven").click(function(){
    $(".menu-icon-show-eleven").toggleClass("fa-angle-down fa-angle-right" );
  });

  $(".icon-show-hide-twelve").click(function(){
    $(".menu-icon-show-twelve").toggleClass("fa-angle-down fa-angle-right" );
  });

  $(".icon-show-hide-thirten").click(function(){
    $(".menu-icon-show-thirten").toggleClass("fa-angle-down fa-angle-right" );
  });

  $(".icon-show-hide-fourten").click(function(){
    $(".menu-icon-show-fourten").toggleClass("fa-angle-down fa-angle-right" );
  });

  $(".shop-page-search-show-hide").click(function(){
    $(".tab-menu-search").toggle();
  });

  $(".new-customer-button").click(function(){
    $(".new-customer-hidden-label").toggle();
    /*$(".new-customer-hidden-label").fadeToggle(8000);*/
  });

    $('nav ul li a').filter(function(){
        return this.href === location.href;
        }).addClass('active-menu');

});
