HbgKiosk = HbgKiosk || {};
HbgKiosk.Overlays = HbgKiosk.Overlays || {};

HbgKiosk.Overlays.Preloader = (function ($) {

    function Preloader() {
        $(function(){

            this.init();

        }.bind(this));
    }

    Preloader.prototype.init = function () {
		$(".metro-grid-item a[tabindex], a[tabindex].slider-row").click(function(event){
			jQuery("body").addClass("doing-preload"); 
		}).bind(this); 
    };

    return new Preloader();

})(jQuery);