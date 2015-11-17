HbgKiosk = HbgKiosk || {};
HbgKiosk.Screensaver = HbgKiosk.Screensaver || {};

HbgKiosk.Screensaver.Screensaver = (function ($) {

    var delay = 7000;
    var slideItemSelector = '.screensaver-slide';
    var slideItemActiveSelector = '.screensaver-slide.active';

    function Screensaver() {
        $(function(){

            this.init();

        }.bind(this));
    }

    Screensaver.prototype.init = function () {
        if ($('body').hasClass('screensaver')) {
            this.startSlider();
        }
    };

    Screensaver.prototype.startSlider = function () {
        $(slideItemSelector).first().addClass('active');

        var delay = $(slideItemSelector).first().data('timeout');

        setTimeout(function () {
            this.nextSlide();
        }.bind(this), delay);
    };

    Screensaver.prototype.nextSlide = function () {
        var next = $(slideItemActiveSelector).next(slideItemSelector);
        if (!next.length) {
            next = $(slideItemSelector).first();
        }

        $(slideItemActiveSelector).removeClass('active').fadeOut();
        next.addClass('active').show();

        var delay = next.data('timeout');

        setTimeout(function () {
            this.nextSlide();
        }.bind(this), delay);

        //$(slideItemActiveSelector).hide().removeClass('active').next(slideItemSelector).addClass('active').show();
    };


    return new Screensaver();

})(jQuery);