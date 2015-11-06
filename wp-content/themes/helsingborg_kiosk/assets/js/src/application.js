	var HbgKiosk; HbgKiosk = HbgKiosk || {};
	
	
	/****************************************************
	 *
	 *	Time function (the clock)
	 *
	 ****************************************************/
	
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

	
	/****************************************************
	 *
	 *	GOOGLE MAPS API 
	 *
	 ****************************************************/
	 
	jQuery(function(){
		
		if ( jQuery('#map-canvas').length ) { 
		
			var thisAdress = jQuery('#map-canvas').attr("data-adress").trim(); 
			
			if ( thisAdress !== "" ) { 
				
				var map = new GMaps({
		        	div: '#map-canvas',
					lat: -12.043333,
					lng: -77.028333
		      	});
		      	
		        GMaps.geocode({
		          address: thisAdress,
		          callback: function(results, status){
		            if(status=='OK'){
		              var latlng = results[0].geometry.location;
		              map.setCenter(latlng.lat(), latlng.lng());
		              map.addMarker({
		                lat: latlng.lat(),
		                lng: latlng.lng()
		              });
		              map.setZoom(16); 
		            }
		          }
		        });   
	        }
	        
        }
        
	}); 
	 
	