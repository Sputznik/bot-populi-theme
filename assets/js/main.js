jQuery(document).ready(function($){

    $(".navbar-toggler, .li-close-btn").on('click', function() {
        $('.btp-navbar-collapse, .li-close-btn').toggleClass('openMobileMenu');
    });



    $(window).on('scroll resize', function () {
        $el = $('.navbar .navbar-brand img.logo-large');
    
        if( $(window).width() > 760 ) {
            
            if ($(this).scrollTop() > 100 ) { 
                $el.attr('src', btp_settings.logo.medium);
                    
            } else if ($(this).scrollTop() < 50 ) { 
                $el.attr('src', btp_settings.logo.large);
            }
        }

    })
        
    

});