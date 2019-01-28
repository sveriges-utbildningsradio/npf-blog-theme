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


    // Help bar
    $('.help-button').click(function(){
        $('.help-overlay').addClass('show');
    });

    $('.help-close').click(function(){
        $('.help-overlay').removeClass('show');
    });

    $('.help-overlay li label').on('click', function(e){

        var allTerms = [],
            cat = "",
            moreLink,
            allTaxTypes = [];

        if ($(this).parents('ul').hasClass('cat')) {
            $('ul.cat label').removeClass('active');
            $(this).toggleClass('active');
        } else {
            $(this).toggleClass('active');    
        }
        
        $('.help-overlay li label.active').each(function(){

            // Save tag slug
            if (allTerms.indexOf($(this).data('term')) === -1 && $(this).data('term') !== undefined) {
                allTerms.push($(this).data('term'));
            }

            // Save taxonomy type
            if (allTaxTypes.indexOf($(this).data('type')) === -1 && $(this).data('term') !== undefined) {
                allTaxTypes.push($(this).data('type'));
            }

            if($(this).parents('ul').hasClass('cat')){
                cat = $(this).data('cat');

                if ($(this).data('cat') !== "") {
                    moreLink = $('.show-more').data('url') + "/" + $(this).data('cat');
                }
            }
        });

        moreLink = $('.show-more').data('url') + "/?alter=1";

        if (allTerms !== undefined && allTerms.length > 0) {
            moreLink += "&terms=" + allTerms + "&tax=" + allTaxTypes;
        }

        if (cat !== undefined && cat !== "") {
            moreLink += "&cate=" + cat;
        }


        var data = {
            'action' : 'get_help_results',
            'terms' : allTerms,
            'query': loadmore_params.posts,
            'category' : cat,
            'taxonomies' : allTaxTypes
        };

        if (allTerms.length > 0 || cat !== "") {
            $.ajax({
              type: "POST",
              url: loadmore_params.ajaxurl,
              data: data,
              beforeSend : function ( xhr ) {
                $('.help-results .row').html("");
                $('.help-overlay .loader').addClass('loading');
                $('.show-more-text').css('visibility', 'hidden');
              },

              success: function(data){

                $('.help-overlay .loader').removeClass('loading');
                $('.show-more').attr('href', moreLink);

                if (data !== "") {
                    $('.help-results .row').html("");
                    $('.help-results .row').append('<div class="col-12"><h3>Resultat</h3></div>');
                    $('.help-results .row').append(data);

                    var numberOfPosts = Number($('.help-results .item').data('count'));

                    $('.help-results h3').text( numberOfPosts + ' resultat');

                    $('#mobHelper h3').text('Visa resultat (' + numberOfPosts + ')');

                    $("#mobHelper").click(function() {
                        $('#helpOverlay').animate({
                            scrollTop: $(".help-results")[0].offsetTop - 10
                        }, 500);
                        $(this).removeClass('show');
                    });
                    $('#mobHelper').addClass('show');

                    if (numberOfPosts > 3) {
                        $('.show-more-text').text('Visa mer');
                        $('.show-more-text').css('visibility', 'visible');
                    }
                } else {
                    $('#mobHelper').removeClass('show');
                    $('.help-results .row').html("");
                    $('.show-more-text').css('visibility', 'visible');
                    $('.show-more-text').text('Inga resultat');
                }
              },
            });
        } else {
            $('.help-results .row').html("");
        }
    });

    $('.loadmore-manual').click(function(){
        var hiddenRows = $('.view-more-row.hide');
        if (hiddenRows.length >= 3) {
            $('.view-more-row.hide')[2].classList.remove('hide');
            $('.view-more-row.hide')[1].classList.remove('hide');
            $('.view-more-row.hide')[0].classList.remove('hide');
            if (hiddenRows.length === 1) { $(this).fadeOut(); }
        } else if (hiddenRows.length === 2) {
            $('.view-more-row.hide')[1].classList.remove('hide');
            $('.view-more-row.hide')[0].classList.remove('hide');
            if (hiddenRows.length === 1) { $(this).fadeOut(); }
        } else if (hiddenRows.length === 1) {
            $('.view-more-row.hide')[0].classList.remove('hide');
            if (hiddenRows.length === 1) { $(this).fadeOut(); }
        } else {
            $(this).fadeOut();
        }
    });



})(jQuery);