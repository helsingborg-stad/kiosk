HbgKiosk = HbgKiosk || {};
HbgKiosk.Screensaver = HbgKiosk.Screensaver || {};

HbgKiosk.Screensaver.Screensaver = (function ($) {

    function Screensaver() {
        $(function(){

            this.init();

        }.bind(this));
    }

    Screensaver.prototype.init = function (element) {
        if ($('body').hasClass('screensaver')) {
            alert("Screensaver!");
        }
    };

    return new Screensaver();

})(jQuery);