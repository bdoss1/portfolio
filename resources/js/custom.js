$(document).ready(function () {
    $(window).load(function () {

        // will first fade out the loading animation
        $(".loader").fadeOut();
        // will fade out the whole DIV that covers the website.
        $(".preloader").delay(1000).fadeOut("slow");
    });


    // RESPONSIVE MENU
    $('.nav-icon').click(function () {
        $('body').toggleClass('full-open');
    });

});