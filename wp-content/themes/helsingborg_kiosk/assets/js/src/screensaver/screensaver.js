HbgKiosk = HbgKiosk || {};
HbgKiosk.Screensaver = HbgKiosk.Screensaver || {};

HbgKiosk.Screensaver.Screensaver = (function ($) {

    var delay = 7000;
    var slideItemSelector = '.screensaver-slide';
    var slideItemActiveSelector = '.screensaver-slide.active';
    var ctaSelector = '.screensaver-cta';

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
        var cta = $(slideItemSelector).first().data('cta');

        if (cta) {
            $(ctaSelector).fadeIn();
        } else {
            $(ctaSelector).fadeOut();
        }

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
        var cta = next.data('cta');

        if (cta) {
            $(ctaSelector).fadeIn();
        } else {
            $(ctaSelector).fadeOut();
        }

        setTimeout(function () {
            this.nextSlide();
        }.bind(this), delay);
    };


    return new Screensaver();

})(jQuery);