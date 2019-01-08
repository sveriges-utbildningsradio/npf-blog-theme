(function($) {

    // MOBILE MENU
    $( '.mobile-menu' ).click(function() {

        $('body').toggleClass('menu-active');
        $('.navigation').toggleClass('active');
        
        if ($( '.navigation' ).hasClass( 'active' )) {
            $('.navigation').animate({
                left: '0'
            }, 500);

            // click outside navigation to close menu
            var $menu = $('.navigation, .mobile-menu');
            $(document).mouseup(function (e) {
                if (!$menu.is(e.target) && $menu.has(e.target).length === 0) {
                    /* jshint latedef:nofunc */
                    closeMenu();
                }
            });

        } else {
            $('.navigation').animate({
                left: '-100%'
            }, 500);
        }

        // close menu when click outside
        /* jshint latedef:nofunc */
        function closeMenu() {
            if ($( '.navigation' ).hasClass( 'active' )) {
                $( '.navigation' ).removeClass( 'active' );
                $('body').removeClass('menu-active');

                $('.navigation').animate({
                    left: '-100%'
                }, 500);
            }
        }
    });

    //filter front page menu
    $('.filter-btn').click(function() {
        $target = $('.filter-btn');
        var topPos = $target.offset().top;
        $('body').toggleClass( 'filter-active' );

        $('.searchandfilter').toggleClass( 'active' );

        if ($( '.searchandfilter' ).hasClass( 'active' )) {

            $('.searchandfilter').slideDown( 'slow' );
            
            $('html, body').animate({scrollTop: topPos + 8},800);
            return false;

        } else {

            $('.searchandfilter').slideUp( 'slow' );
        }

    });

    //share buttons
    $('.share').click(function() {

        $('.share').toggleClass( 'active' );

        if( $('.share').hasClass( 'active' ) ) {

            $('.so-me').fadeIn("slow");
            $('.share').css('color', '#EF7D24');

        } else {

            $('.so-me').fadeOut("slow");
            $('.share').css('color', 'unset');

        }
    });

    // copy link when selected - share on social media
    $('#copy-url').click(function() {
        this.select();
        document.execCommand('copy');
        document.getElementById('copy-txt').innerHTML = 'Kopierad!';
        $('#copy-txt').delay(2000).fadeOut();
    });

    // copy link when selected - share on social media
    $('#copy-link').click(function() {
        var copyText = document.getElementById('copy-url');
        copyText.select();
        document.execCommand('copy');
        document.getElementById('copy-txt').innerHTML = 'Kopierad!';
        $('#copy-txt').delay(2000).fadeOut();
    });

    // carousel
    $('.carousel').carousel({
        interval: $('.carousel').data('time')
    });

    $('#click').click(function () {

        $('body').toggleClass( 'video-active' );

        if (this.paused === false) {
            $('#click').get(0).pause();

            if(this.paused === true) {
                $('#click').mouseout(function() {
                    $('.play').hide();
                    $('.pause').hide();
                });
                $('#click').mouseover(function() {
                    $('.play').show();
                    $('.pause').hide();
                });
            } else {
                $('.pause').hide();
            }

        } else {
            $('#click').get(0).play();

            if(this.paused === false) {
                $('#click').mouseout(function() {
                    $('.pause').hide();
                    $('.play').hide();
                });
                $('#click').mouseover(function() {
                    $('.pause').show();
                    $('.play').hide();
                });
            } else {
                $('.play').hide();
            }
        }
    });

    //VIDEOTACKING
    var i = 0;
    var p = 0;
    var j = 0;

    /* Video Watched */
    $('#click').bind('timeupdate', function() {
        var videoUrl = $(this).attr( 'data-url' );
        var currentTime = this.currentTime;
        
        if( currentTime > 0.50 * ( this.duration ) ) {
            if( i < 1 ) {
                /* Watched 50% */
                ga('send', 'event', {
                    eventCategory: 'Video',
                    eventAction: 'Tittat 50%',
                    eventLabel: videoUrl
                });
            }
        i = i + 1; //Reset for duplicates 
        }
    });
    $('#click').bind('timeupdate', function() {
        var videoUrl = $(this).attr( 'data-url' );
        var currentTime = this.currentTime;

        if( currentTime > 0.90 * ( this.duration ) ) {
            if( p < 1 ) {
                /* Watched 90% */
                ga('send', 'event', {
                    eventCategory: 'Video',
                    eventAction: 'Tittat 90%',
                    eventLabel: videoUrl
                });
            }
        p = p + 1; //Reset for duplicates 
        }
    });

    /* Video Finished, Thanks */
    $('#click').bind('ended', function() {
        var videoUrl = $(this).attr('data-url');

        if( j < 1) {
            /* Finished */
            ga('send', 'event', {
                eventCategory: 'Video',
                eventAction: 'Tittat 100%',
                eventLabel: videoUrl
            });
        }
        j = j + 1; //Reset for duplicates
    });

    // Scroll button
    //Check to see if the window is top if not then display button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 700) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.scrollToTop').click(function(){
        $target = $('.filter-btn');
        var topPos = $target.offset().top;
        $('html, body').animate({scrollTop : topPos - 200},800);
        return false;
    });

    //Widgets
    var widget = document.getElementById( 'widget' );
    $( '.searchandfilter div' ).before( widget );

    //Hide Category forever - Inspiration
    $('.cat-item-4').hide();

})(jQuery);