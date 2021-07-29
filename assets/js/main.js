jQuery(document).ready(function($){

    $(".navbar-toggler, .li-close-btn").on('click', function() {
        $('.btp-navbar-collapse, .li-close-btn').toggleClass('openMobileMenu');
    });



    $(window).on('scroll resize', function () {
        $el = $('.navbar .navbar-brand img.logo-large');
    
        if( this.matchMedia("(min-width: 768px)").matches ) {
            
            if ($(this).scrollTop() > 100 ) { 
                $el.attr('src', btp_settings.logo.medium);
                    
            } else if ($(this).scrollTop() < 50 ) { 
                $el.attr('src', btp_settings.logo.large);
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

        
    

});