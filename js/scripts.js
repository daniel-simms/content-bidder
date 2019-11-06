$(document).ready(function() {

     // ENTER NOTIFICATION
     $('.notification').css("right", "10px");

    // TIMOUT FOR SUCCESS NOTIFICATION
    setTimeout(function() {
        $('.notification').css("right", "-500px");
        $('.notification').fadeOut('fast');
    }, 5000);

    // CLOSE BUTTON FOR SUCCESS NOTIFICATION
    $('.close').on("click", function () {
        $(this).parents('div').css("right", "-500px");
        $(this).parents('div').fadeOut('fast');
    }); 
    
    // STICKY NOTIFICATION
    $(window).scroll( function(){
        var pos = $(window).scrollTop();
        if( pos >= 94 ){
            $(".notification").css({
                                "position": "fixed",
                                "top": "5px"
                                });
        }
    });

    // HAMBURGER MENU
    var $hamburger = $(".hamburger");
    $hamburger.on("click", function(e) {
    $hamburger.toggleClass("is-active");
        $('.header-nav ul').toggleClass("nav-hide");
    });
    

   

});