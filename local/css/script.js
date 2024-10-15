$("#breadcrumb").addClass('breadcrumb');
$("p img").addClass('img-responsive');
$("p iframe").wrap("<div class='embed-responsive embed-responsive-16by9'></div>");
$("table").wrap("<div class='table-responsive'></div>");

$("#srcoll").click(function() {
    var targetID = $(this).attr("href");
    $("html, body").animate({ scrollTop: $(targetID).offset().top }, 700);
    return false;
});

var textbox = $(".textbox");
var textarea = $("<textarea id='textarea' class='form-control' name='Content' placeholder='Note' rows='8' required></textarea>");
textarea.val(textbox.val());
textbox = textbox.replaceWith(textarea);


var activeurl = window.location.pathname;
$('a[href="' + activeurl + '"]').parent('li').addClass('active');

/*
$('.mg-check-in').datepicker({
	format: 'yyyy-mm-dd',
	//startDate: "dateToday",
	startDate:'+1d',
	autoclose: true,
});
*/

$('#search').click(function() {
    $("#f_search").validate({
        debug: false,
        errorClass: "text-danger",
        errorElement: "span",
        submitHandler: function() {
            $.ajax({
                url: "/layout/ket-qua-tim-kiem.php",
                type: "POST",
                data: $('#f_search').serialize(),
                beforeSend: function() { $('#container').html('<img class="center-block" src="/images/loading.gif" alt="loading">'); },
                success: function(response) { $('#container').html(response); },
            });
        }
    });
});

$("#button_submit").click(function() {
    $("#form_submit").validate({
        debug: false,
        errorClass: "text-danger",
        errorElement: "span",
        submitHandler: function() {
            $.ajax({
                url: "/PHPMailer/send-to-mail.php",
                type: "POST",
                data: $('#form_submit').serialize(),
                beforeSend: function() { $('#form_submit').html('<img class="center-block" src="/images/loading.gif" alt="loading">'); },
                success: function(response) { $('#form_submit').html(response); },
            });
        }
    });
});

function show_modal_id(id) {
    $.ajax({
        url: "/layout/show_modal_id.php?id=" + id,
        beforeSend: function() {
            $('#load_modal').html('<div class="loading"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></div>');
            $("#modal").modal();
        },
        success: function(msg) {
            $("#load_modal").html(msg);
        },
    });
};

(function($) {
    $("#menu-san-pham ul").parent().addClass('menu-has-children');


    $('.parallax').parallax("50%", 0.2);

    /*
     * Custom Data Fixed
     */
    $('.beactive').addClass('active');
    $('.beactive').removeClass('beactive');

    /*
     * Booking progress line JS
     */
    $('.mg-booking-form > ul > li:nth-child(1)').click(function() {
        if ($('.mg-booking-form > ul > li:nth-child(1)').hasClass('mg-step-done')) {
            $('.mg-booking-form > ul > li:nth-child(1)').removeClass('mg-step-done');
        }
        if ($('.mg-booking-form > ul > li:nth-child(2)').hasClass('mg-step-done')) {
            $('.mg-booking-form > ul > li:nth-child(2)').removeClass('mg-step-done');
        }
        if ($('.mg-booking-form > ul > li:nth-child(3)').hasClass('mg-step-done')) {
            $('.mg-booking-form > ul > li:nth-child(3)').removeClass('mg-step-done');
        }

        if ($('.mg-booking-form > ul > li:nth-child(4)').hasClass('mg-step-done')) {
            $('.mg-booking-form > ul > li:nth-child(4)').removeClass('mg-step-done');
        }
    });

    $('.mg-booking-form > ul > li:nth-child(2)').click(function() {
        $('.mg-booking-form > ul > li:nth-child(1)').addClass('mg-step-done');

        if ($('.mg-booking-form > ul > li:nth-child(2)').hasClass('mg-step-done')) {
            $('.mg-booking-form > ul > li:nth-child(2)').removeClass('mg-step-done');
        }
        if ($('.mg-booking-form > ul > li:nth-child(3)').hasClass('mg-step-done')) {
            $('.mg-booking-form > ul > li:nth-child(3)').removeClass('mg-step-done');
        }

        if ($('.mg-booking-form > ul > li:nth-child(4)').hasClass('mg-step-done')) {
            $('.mg-booking-form > ul > li:nth-child(4)').removeClass('mg-step-done');
        }
    });

    $('.mg-booking-form > ul > li:nth-child(3)').click(function() {
        $('.mg-booking-form > ul > li:nth-child(1)').addClass('mg-step-done');
        $('.mg-booking-form > ul > li:nth-child(2)').addClass('mg-step-done');

        if ($('.mg-booking-form > ul > li:nth-child(3)').hasClass('mg-step-done')) {
            $('.mg-booking-form > ul > li:nth-child(3)').removeClass('mg-step-done');
        }

        if ($('.mg-booking-form > ul > li:nth-child(4)').hasClass('mg-step-done')) {
            $('.mg-booking-form > ul > li:nth-child(4)').removeClass('mg-step-done');
        }
    });

    $('.mg-booking-form > ul > li:nth-child(4)').click(function() {
        $('.mg-booking-form > ul > li:nth-child(1)').addClass('mg-step-done');
        $('.mg-booking-form > ul > li:nth-child(2)').addClass('mg-step-done');
        $('.mg-booking-form > ul > li:nth-child(3)').addClass('mg-step-done');

        if ($('.mg-booking-form > ul > li:nth-child(4)').hasClass('mg-step-done')) {
            $('.mg-booking-form > ul > li:nth-child(4)').removeClass('mg-step-done');
        }
    });

    $('.btn-next-tab').click(function(e) {

        e.preventDefault();

        // console.log($($(this).attr('href')));
        $(this).tab('show');

        $('html, body').animate({
            scrollTop: $(".mg-booking-form").offset().top - 100
        }, 300);

        $('a[href="' + $(this).attr('href') + '"]').parents('li').trigger('click');
        $('.mg-booking-form > ul > li.active').removeClass('active');
        $('a[href="' + $(this).attr('href') + '"]').parents('li').addClass('active');
    });

    $('.btn-prev-tab').click(function(e) {

        e.preventDefault();

        // console.log($($(this).attr('href')));
        $(this).tab('show');

        $('html, body').animate({
            scrollTop: $(".mg-booking-form").offset().top - 100
        }, 300);

        $('a[href="' + $(this).attr('href') + '"]').parents('li').trigger('click');
        $('.mg-booking-form > ul > li.active').removeClass('active');
        $('a[href="' + $(this).attr('href') + '"]').parents('li').addClass('active');
    });

    /*
     * Main Menu dropdown at Hover
     */
    if ($(window).width() <= 768) {
        //var $iframe = $('iframe');
        //var $parent = $iframe.parent();
        //$parent.addClass('embed-responsive embed-responsive-16by9');

        $('.dropdown').hover(
            function() {
                $(this).addClass('open');
            },
            function() {
                $(this).removeClass('open');
            }
        );
    }

    $('.loop').owlCarousel({
        loop: true,
        delay: 4000,
        speed: 1000,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        nav: false,
        dots: false,
        lazyLoad: true,
        margin: 14,
        video: true,

        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            960: {
                items: 4,
            },
            1200: {
                items: 5
            }
        }
    });

    $('.san-pham').owlCarousel({
        loop: false,
        autoplay: false,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        nav: true,
        dots: false,
        lazyLoad: true,
        margin: 14,
        video: true,
        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        navClass: ["owl-prev", "owl-next"],
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            960: {
                items: 4,
            },
            1200: {
                items: 5
            }
        }
    });

    $('.gallery_sp').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        nav: true,
        dots: false,
        lazyLoad: true,

        video: true,
        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        navClass: ["owl-prev", "owl-next"],
        responsive: {
            0: {
                items: 1
            },

        }
    });
    /*
     * Single room review ratting
     */
    $('#mg-star-position').on('starrr:change', function(e, value) {
        $('#mg-star-position-input').val(value);
    });

    $('#mg-star-comfort').on('starrr:change', function(e, value) {
        $('#mg-star-comfort-input').val(value);
    });

    $('#mg-star-price').on('starrr:change', function(e, value) {
        $('#mg-star-price-input').val(value);
    });

    $('#mg-star-quality').on('starrr:change', function(e, value) {
        $('#mg-star-quality-input').val(value);
    });

    /*
     * Nivo Lightbox for gallery
     */
    $('.mg-gallery-item a').nivoLightbox({ effect: 'fadeScale' });
})(jQuery);

$(window).load(function() {
    /*
     * Gallery Filter with Shuffle
     */
    var $grid = $('#mg-grid'),
        $sizer = $grid.find('.shuffle__sizer'),
        $filterType = $('#mg-filter input[name="filter"]');



    $('label.btn-main').removeClass('btn-main');
    $('input[name="filter"]:checked').parent().addClass('btn-main');

    $filterType.change(function(e) {
        var group = $('#mg-filter input[name="filter"]:checked').val();

        $grid.shuffle('shuffle', group);

        $('label.btn-main').removeClass('btn-main');
        $('input[name="filter"]:checked').parent().addClass('btn-main');
    });
    $('.preloader').fadeOut("slow");
});