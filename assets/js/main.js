jQuery(document).ready(function($){

    $(".navbar-toggler, .li-close-btn").on('click', function() {
        $('.btp-navbar-collapse, .li-close-btn').toggleClass('openMobileMenu');
    });



    $(window).on('scroll resize', function () {
        $el = $('.navbar .navbar-brand img.logo-large');
    
        if( this.matchMedia("(min-width: 768px)").matches ) {
            
            if ($(this).scrollTop() > 100 ) { 
                $el.attr('src', btp_settings.logo.medium);
                // $el.fadeOut(400, function(){
                //     $el.attr('src', btp_settings.logo.medium).fadeIn(400);
                // });
                    
            } else if ($(this).scrollTop() < 50 ) { 
                $el.attr('src', btp_settings.logo.large);
                // $el.fadeOut(400, function(){
                //     $el.attr('src', btp_settings.logo.large);
                // });
            }
        }

    })


    $(window).on("load resize", function() {

        const $dropdown = $(".dropdown");
        const $dropdownToggle = $(".dropdown-toggle");
        const $dropdownMenu = $(".dropdown-menu");
        const showClass = "show";

        if (this.matchMedia("(min-width: 768px)").matches) {
            $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });


    window.onscroll = function() {
        var indicator = document.querySelector(".progress-indicator");
        
        if(indicator) {
            var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var scrolled = (winScroll / height) * 100;
        
            indicator.style.height = scrolled + "%";
        }
    };

    $('.search .custom-select').change(function(){
        this.form.submit();
    });
    
     

    $(".btp-copy-link").on( 'click', function(ev) {
        ev.preventDefault();
        var data = $(ev.target).parent().attr('href');
        navigator.clipboard.writeText( data ).then( function() {
            $(".flash-message").append('<div class="alert alert-warning alert-dismissible fade show" role="alert"> link copied to clipboard <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }, function() {
            console.log('clipboard write failed');
        });
    });

   
});