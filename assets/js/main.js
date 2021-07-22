jQuery(document).ready(function($){

    $(".navbar-toggler, .li-close-btn").on('click', function() {
        $('.btp-navbar-collapse, .li-close-btn').toggleClass('openMobileMenu');
    });

});