	
	HbgKiosk = HbgKiosk || {};
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
			
			//Add start pin
			map.addMarker({
		        lat: kioskLatitude,
		        lng: kioskLongitude,
		        icon: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAABVElEQVRIS72Vy1HDQBBE37jEGREBygD7AFeUAUsEmAwgA8jAzoAQ5AiQr+hgheAMMGdcHmpkuUoyH8mylrmp1Nu90z27K3gu8cyPLHDRGu58CAUwlTdcLnDhQwBIJcNphXzeUigCzttgqwLPlyRPbRYtcOEa3g0bwNmIZFVdV3Wlk4CR7TpXMItrAsAQCA13tEBTx30IPAosTUhhJRAqTHYZHS2gcG+kQKyQCLjSnuteLFIYlbuOTiD9hFhgDPQvAOQWcK8CArcKkcJwAMkGnICdk28dJIpYOI01KAj1pfAYMTvYoCFIDmojOpbtqNbGtJG4C2D/qujC8eeaqsAH2/ltU9b+TQmcleEWnwphGfJpzSKF6RXJQxv2DBcDr7/dRRku/Slkw9uPxrKpKSfFdrzcneRKB0XA/xOy5wdnbk+m3e2tvG/0bg8QwMT/o3/org7FfwFKNovMT1YG0wAAAABJRU5ErkJggg=='
		    });
		      
			//Add destionation pin
			map.addMarker({
		        lat: poiLatitude,
		        lng: poiLongitude,
		        icon: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAACTklEQVRIS7WWwXEaQRBFX1twlhyBcQSCKi1X4wg8RGAcgZWBQ7AcgVEEDBEYXcFVoAiMMoAzyOP6y6y0rHaX1cFTRRVD9Ux3///7D0aDNceNDD4D3Ri+Mmx8xeT21HGrC1jiOjuY2PPFR+EBVm0Y9vDrqnsqEyxxFztYGnTqigiwbkOvh9+UxVUmmOPGERad2xqMrvBem984F2AMnGsf4Ecff/2qBAucKkovMBiewewR+6T9GWG6A2fwM166SfBvGydY4AbAr+xAgrdIdHphgC99/HiBGnlaHxP8rJikFKL/nkDq2cOfrJqsYmGv38RFviP91oL3ZWqqJDnPAbAx7DrT/QInQr8BF7GIbYLPvh+h1FRFtfMU4LaPHzUmWYFFHk5MbCnBUYHVRxc4qeLDicvvErxUV7pqraJhF5XVn+wgQqXpTQesuOqwz2JrO1BQlOwqm+pckm0LunVG16iD2IVk+T3fQTYbJ/iRzbxcBye1yzepk4atBmuBy0M1TfDuMHh2/jd11HBf5qhPCea4rtwzwKDo/wF6bVjvQVBpars76JgQzC29DwazyE0aa6p2DxPgSGoB7g30kOjQKtpD+qL18atoFXoruuGQ7LKAxawFQ8tpfSuPN/BlrngK68jVIBxsXFMtq58pgap8pw3YTcJk2uSyqpj4GH2NiDzI54W9CFSSbGmCheUGLMXyAM3k7rlSi29B0HkZnSDOw/wQu0m1Lh5GAfTvoYjlqxqK3I1bMJaqXshUyR5BWIpQfTIbLnpS2o2sPBOCntWiVP8BnyndZ58uGu4AAAAASUVORK5CYII'
		    });
		    
		    //Draw route 
		    map.drawRoute({
		        origin: [kioskLatitude, kioskLongitude],
		        destination: [poiLatitude, poiLongitude],
		        travelMode: 'walking',
		        strokeColor: '#ae0b05', 
		        strokeOpacity: 1,
		        strokeWeight: 3
		    });
		    
		    //Zoom
		    map.fitZoom();
			
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