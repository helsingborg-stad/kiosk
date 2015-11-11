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
	
	/****************************************************
	 *
	 *	Hide  helpers after 3S 
	 *
	 ****************************************************/
	 if ( jQuery("#helperGesture").length ) { 
		 setTimeout(function(){
		    document.getElementById('helperGesture').className = 'hand-gestrure-swipe has-ended';
		 }, 3000);
	 }

	/****************************************************
	 *
	 *	Go one step back
	 *
	 ****************************************************/
		 
	jQuery(function(){
		jQuery(".one-step-back").click(function(event){
			event.preventDefaul(); 
			window.history.back();
		}); 
	}); 
	
	/****************************************************
	 *
	 *	Webcam functions 
	 *
	 ****************************************************/
	 
	 //Docs: https://github.com/jhuckaby/webcamjs
	
	/*Webcam.set({
        width: 1080,
        height: 1080,
        dest_width: 640,
        dest_height: 480,
        image_format: 'jpeg',
        jpeg_quality: 90,
        force_flash: false,
        flip_horiz: true,
        fps: 45
    });
	
	Webcam.attach( '#my_camera' );

    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }*/ 
