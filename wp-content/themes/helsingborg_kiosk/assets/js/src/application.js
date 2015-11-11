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
	 
	HbgKiosk.VisualMap = HbgKiosk.VisualMap || {};
	HbgKiosk.VisualMap.VisualMap = (function ($) {
		
		//Declare map object 
		var map 					= ""; 
		var mapObject 				= ""; 
		var geoLocationCookieName 	= "kioskGetLocationCookie"; 
		var timeToSaveLocation 		= 7; //Number of days (erase by assigning val -1)
		
		function VisualMap() {
	        jQuery(function(){
	            this.InitMap(); 
	        }.bind(this));
	    }
	    
	    VisualMap.prototype.InitMap = function() {
		    
		    if ( jQuery('#map-canvas').length ) { 

				//Assign object 
				var mapObject 		= jQuery('#map-canvas'); 
			
				//Get lat/long
				var poiLatitude 	= mapObject.attr("data-latitude").trim().replace(/,/g, '.');
				var poiLongitude 	= mapObject.attr("data-longitude").replace(/,/g, '.');
				
				//"validate" data 
				if ( poiLatitude != "" && poiLongitude != "" ) { 
					
					//Set default location 
					map = new GMaps({
				        div: '#map-canvas',
				        lat: poiLatitude,
				        lng: poiLongitude
				    });
				    
				    //Use stored value if defined, else use new val and store
				    if ( !this.GetCookie(geoLocationCookieName + "_lat") && !this.GetCookie(geoLocationCookieName + "_long") ) {
					    
					    GMaps.geolocate({
						    
							success: function(position) {

								//Set cookie data 
								HbgKiosk.VisualMap.VisualMap.SetCookie(geoLocationCookieName + "_lat" , position.coords.latitude, timeToSaveLocation); 
								HbgKiosk.VisualMap.VisualMap.SetCookie(geoLocationCookieName + "_long" , position.coords.longitude, timeToSaveLocation); 
								
								//Draw map 
								HbgKiosk.VisualMap.VisualMap.DrawMap(poiLatitude, poiLongitude, position.coords.latitude, position.coords.longitude ); 
								
							}
							
						});	
					    
				    } else {
						
						//Draw map 
						this.DrawMap(poiLatitude, poiLongitude, this.GetCookie(geoLocationCookieName + "_lat"), this.GetCookie(geoLocationCookieName + "_long") ); 
						
				    }
								      
		        }
		        
	        }
		    
	    }
		
		VisualMap.prototype.DrawMap = function (poiLatitude, poiLongitude, kioskLatitude, kioskLongitude) {
			
			//Add destionation pin
			map.addMarker({
		        lat: poiLatitude,
		        lng: poiLongitude
		    });
		    
		    //Set kiosk location 
		    //map.setCenter(kioskLatitude, kioskLongitude);
		    
		    //Draw route 
		    map.drawRoute({
		        origin: [56.0404952, 12.7012502],
		        destination: [poiLatitude, poiLongitude],
		        travelMode: 'walking',
		        strokeColor: '#ae0b05', 
		        strokeOpacity: 1,
		        strokeWeight: 10
		    });
		    
		    //Zoom
		    //map.setZoom(12);
			
		}
		
		VisualMap.prototype.GetCookie = function (cname) {
		    var name = cname + "=";
		    var ca = document.cookie.split(';');
		    for(var i=0; i<ca.length; i++) {
		        var c = ca[i];
		        while (c.charAt(0)==' ') c = c.substring(1);
		        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
		    }
		    return "";
		}
		
		VisualMap.prototype.SetCookie = function(cname, cvalue, exdays) {
		    var d = new Date();
		    d.setTime(d.getTime() + (exdays*24*60*60*1000));
		    var expires = "expires="+d.toUTCString();
		    document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";
		}
	
		return new VisualMap();
		
	})(jQuery);
	
	
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

