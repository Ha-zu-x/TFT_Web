//' +  $('select').children('option:selected').data('page') + '
var page_selectBox = $('select').children('option:selected').data('page');
//$('h1').html("<b>Trang </b>");
if ($('.sau').data("page") == page_selectBox) {
    $('.sau').attr("disabled", 'disabled');
}
if ($('.truoc').data("page") == page_selectBox) {
    $('.truoc').attr("disabled", 'disabled');
}

$(".btn-page").click(function() {
    var value = $(this).prop("value");
    var page_select = $(this).data('page');

    $.ajax({
        url: "/layout/list-thumb.php?value=" + value,
        beforeSend: function() {
            $('#container').html('<div class="loading"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></div>');
        },
        success: function(msg) {

            var title = '<h1 class="title">Trang ' + page_select + '</h1>';
            $("#container").html(msg);
            $("html, body").animate({ scrollTop: $("#container").offset().top - 100 }, 700);
        },
    });
});

$("#page-opt").change(function() {
    var value = $(this).prop("value");
    var page_selectBox = $(this).find(':selected').data('page');

    $.ajax({
        url: "/layout/list-thumb.php?value=" + value,
        beforeSend: function() {
            $('#container').html('<div class="loading"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></div>');
        },
        success: function(msg) {
            var title = '<h1 class="title">Trang ' + page_selectBox + '</h1>';
            $("#container").html(msg);
            $("html, body").animate({ scrollTop: $("#container").offset().top - 100 }, 700);
        },
    });
});

$(".btn-page-sp").click(function() {
    var value = $(this).prop("value");
    var page_select = $(this).data('page');

    $.ajax({
        url: "/layout/list-san-pham.php?value=" + value,
        beforeSend: function() {
            $('#container').html('<div class="loading"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></div>');
        },
        success: function(msg) {

            var title = '<h1 class="title">Trang ' + page_select + '</h1>';
            $("#container").html(msg);
            $("html, body").animate({ scrollTop: $("#container").offset().top - 100 }, 700);
        },
    });
});

$("#page-opt-sp").change(function() {
    var value = $(this).prop("value");
    var page_selectBox = $(this).find(':selected').data('page');

    $.ajax({
        url: "/layout/list-san-pham.php?value=" + value,
        beforeSend: function() {
            $('#container').html('<div class="loading"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></div>');
        },
        success: function(msg) {
            var title = '<h1 class="title">Trang ' + page_selectBox + '</h1>';
            $("#container").html(msg);
            $("html, body").animate({ scrollTop: $("#container").offset().top - 100 }, 700);
        },
    });
});

$(".btn-page-repair").click(function() {
    var value = $(this).prop("value");
    var page_select = $(this).data('page');
    $.ajax({
        url: "/local/layout/list-sua-chua.php?value=" + value, // Need to edit here before public(removel local)
        beforeSend: function() {
            $('.container-data').html('<div class="loading"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></div>');
        },
        success: function(msg) {

            var title = '<h1 class="title">Trang ' + page_select + '</h1>';
            $(".container-data").html(msg);
            $("html, body").animate({ scrollTop: $(".container-data").offset().top - 100 }, 700);
        },
    });
});

$(".repair-pager .page-item a").click(function(e) {
    e.preventDefault();
    let chosenPage = $(this).attr('href');
    let searchField = $(".selected-value").text();
    let searchKey = $(this).attr('key');
    $.ajax({
        url: "/local/layout/list-sua-chua.php?field=" + searchField + "&key=" + searchKey + "&value=" + chosenPage,
        beforeSend: function() {
            $('.container-data').html('<div class="loading"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></div>');
        },
        success: function(msg) {
            $(".container-data").html(msg);
            $("html, body").animate({ scrollTop: $(".container-data").offset().top - 100 }, 700);
        },
    });
})