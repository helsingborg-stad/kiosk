	
	var HbgKiosk; HbgKiosk = HbgKiosk || {};
	HbgKiosk.Clock = HbgKiosk.Clock || {};
	
	HbgKiosk.Clock.Clock = (function ($) {

		var cDelay = 1000;
		var currentdate = new Date();
		var timeFrame = jQuery(".clock .time");

		function Clock() {
	        jQuery(function(){
	            this.startClock();
	        }.bind(this));
	    }

		Clock.prototype.startClock = function () {
			currentdate = new Date();
			timeFrame.html(currentdate.getHours() + ":" + (currentdate.getMinutes()<10?'0':'') + currentdate.getMinutes() );
	        setTimeout(function () {
	            this.startClock();
	        }.bind(this), cDelay);
	    };

		return new Clock();

	})(jQuery);