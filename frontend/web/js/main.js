/**
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
jQuery(function ($) {
    //offcanvas
    $('#offcanvas-toggler').on('click', function (event) {
        event.preventDefault();
        $('body').addClass('offcanvas');
    });
    $('<div class="offcanvas-overlay"></div>').insertBefore('.body-innerwrapper > .offcanvas-menu');
    $('.close-offcanvas, .offcanvas-overlay').on('click', function (event) {
        event.preventDefault();
        $('body').removeClass('offcanvas');
    });


    //Sticky Menu
    $(document).ready(function () {
        $("body.sticky-header").find('#navigation-bar, #mobile-nav-bar').sticky({topSpacing: 0})
    });


    //Search
    $(".search-icon-wrapper").on('click', function () {
        $(".search-wrapper").fadeIn(200);
    });
    $("#search-close").on('click', function () {
        $(".search-wrapper").fadeOut(200);
    });


    //select menu
    (function () {
        [].slice.call(document.querySelectorAll('select.cs-select')).forEach(function (el) {
            new SelectFx(el);
        });
    })();


    //vertical tabs on hover
    $('.vertical-tabs a').hover(function (e) {
        e.preventDefault()
        $(this).tab('show')
    });


    //article-slider
    $('#article-slider').owlCarousel({
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // Contact form
    var form = $('#main-contact-form');
    form.submit(function (event) {
        event.preventDefault();
        var form_status = $('<div class="form_status"></div>');
        $.ajax({
            url: $(this).attr('action'),
            beforeSend: function () {
                form.prepend(form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>').fadeIn());
            }
        }).done(function (data) {
            form_status.html('<p class="text-success">Thank you for contact us. As early as possible  we will contact you</p>').delay(3000).fadeOut();
        });
    });

    // nanoscroller
    (function () {
        $(".nano").nanoScroller({
            flash: true
        });

    }).call(this);

    //thumb gallery
    $(window).load(function () {
        $('#img_galley').flexslider({
            animation: 'slide',
            controlNav: true,
            directionNav: true,
            animationLoop: false,
            slideshow: false,
            minItems: 5,
            move: 1,
            itemWidth: 129,
            itemMargin: 15,
            asNavFor: '#img_thumb'
        });

        $('#img_thumb').flexslider({
            animation: "fade",
            controlNav: false,
            directionNav: true,
            animationLoop: false,
            slideshow: true,
            sync: "#img_galley"
        });
    });

    $('.newedge-login').on('click', '.login', function () {
        var token = $('meta[name=csrf-token]').attr("content");
        $.post('/user/auth/get-ajax-form/', {formName: 'login', '_csrf-frontend': token}, function (data) {
            $('.modal-header .text-left').text('Log in');
            $('.modal-body').html(data);
            $('.modal-body .form-request-reset').attr('href', '#');
            $('.modal-footer').html('New Here? <a href="#" class="signup-form">Create an account</a>');
            $('.modal-content').on('submit', '#login-form', function (event) {
                event.preventDefault();
                var $this = $(this);
                $.post('/user/auth/login', $this.serialize(), function (data) {
                    $('.modal-body').html(data);
                    if (data == 'success') {
                        location.reload();
                        $('.modal-body').html('')
                    }
                })
            })
        })
    });

    $('.newedge-login').on('click', '.logout', function () {
        var token = $('meta[name=csrf-token]').attr("content");
        $.post('/user/auth/logout', {'_csrf-frontend': token}, function (data) {
            if (data == 'logout_approved') {
                location.reload();
            }
        })
    })

    $('.modal-footer').on('click', '.signup-form', function () {
        var token = $('meta[name=csrf-token]').attr("content");
        $.post('/user/auth/get-ajax-form/', {formName: 'signup', '_csrf-frontend': token}, function (data) {
            $('.modal-header .text-left').text('Signup');
            $('.modal-body').html(data);
            $('.modal-footer').html('For login <a href="#" class="login-form">click here</a>');
            $('.modal-content').on('submit', '#form-signup', function (event) {
                event.preventDefault();
                var $this = $(this);
                $.post('/user/auth/signup', $this.serialize(), function (data) {
                    $('.modal-body').html(data);
                    if (data == 'success') {
                        location.reload();
                        $('.modal-body').html('')
                    }
                })
            })
        })
    })
    $('.modal-footer').on('click', '.login-form', function () {
        var token = $('meta[name=csrf-token]').attr("content");
        $.post('/user/auth/get-ajax-form/', {formName: 'login', '_csrf-frontend': token}, function (data) {
            $('.modal-header .text-left').text('Log in');
            $('.modal-body').html(data);
            $('.modal-body .form-request-reset').attr('href', '#');
            $('.modal-footer').html('New Here? <a href="#" class="signup-form">Create an account</a>');
        });
    })
    $('.modal-body').on('click', '.form-request-reset', function (event) {
        var token = $('meta[name=csrf-token]').attr("content");
        $.post('/user/auth/get-ajax-form/', {formName: 'request-reset', '_csrf-frontend': token}, function (data) {
            $('.modal-header .text-left').text('Request password reset');
            $('.modal-body').html(data);
            $('.modal-footer').html('');
            $('.modal-content').on('submit', '#request-password-reset-form', function (event) {
                event.preventDefault();
                var $this = $(this);
                $.post('/user/auth/request-password-reset', $this.serialize(), function (data) {
                    $('.modal-body').html(data);
                    if (data == 'success') {
                        $('.modal-body').html('Check your email for further instructions.')
                    }
                })
            })
        });
    })

});