(function ($) {
    $(function () {
        var jcarouselProject = $('.jcarouselHot .jcarousel');
        jcarouselProject
            .on('jcarousel:reload jcarousel:create', function() {

            })
            .jcarousel({
                vertical: true,
                wrap: 'circular'
            });
        $('.jcarouselHot .jcarousel').jcarouselAutoscroll({ autostart: true });
        jcarouselProject.hover(function () {
            $(this).jcarouselAutoscroll('stop');
        }, function () {
            $(this).jcarouselAutoscroll('start');
        });
    });
})(jQuery);