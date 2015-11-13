	
	HbgKiosk = HbgKiosk || {};
	HbgKiosk.VisualMap = HbgKiosk.VisualMap || {};
	
	HbgKiosk.VisualMap.VisualMap = (function ($) {
		
		//Declare map object 
		var map 					= ""; 
		var mapObject 				= ""; 
		var geoLocationCookieName 	= "kioskGetLocationCookie"; 
		var timeToSaveLocation 		= 1; //Number of days (erase by assigning val -1)
		
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
				    
					//Get location from db or maps 
					HbgKiosk.VisualMap.VisualMap.GetLocation(poiLatitude, poiLongitude);
								      
		        }
		        
	        }
		    
	    }
		
		VisualMap.prototype.DrawMap = function (poiLatitude, poiLongitude, kioskLatitude, kioskLongitude) {
			
			//Add start pin
			map.addMarker({
		        lat: kioskLatitude,
		        lng: kioskLongitude,
		        icon: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAB5ElEQVRYR82X31HCQBDGf+eQZ7ECsQJhxvAqdnBUoB1IB0IFQgd0wFmB+ArOABUoHcAzjnE2XJiABBJCCPuUP3e73+3u7X6rSCCfaO3BPVD2oKigLNs9GCuYAWNQfZfeW1y1at/CEbq4gFcFGijuW2//C5huAVoVjDxHyk4AQ3QTeE5geNOQGG+7mFYUgq0A7KnfAxfHPHXkMgmRAw/bvPEPwAAtce0pKKU1HN7vwTdQr2LG4e9rAOzJR8c2HhgUEA5Uwp5YAzBASzbfHvPkm7okHFVMJfi+AmAT7iVL4yHdLRcjCY4PQFz/A18psj0p7lkBbiQUPoABuqvgMamWNOs96FQxDR/AEC339TKNwgP2zlzMlbLltXeAgtRbFNRVHu4PXcuOGqL7LBtMHvIhHsj87kedzO+iQ6TD5if5A8g5BJOzSMK2WpKOk4tUw/wLUY6leO5ihNieQTOy7Vgo06ka0rwApVU7tmEQgpAPIQnS/xQ1wYNJFeMPNCtGFLzYUAhrvc7oTk4LUI4kpTYhywpMBiCmHuidtDzsiQX0j8WQxe0O1GINJmHXW6bcSHE75nY08xnwNok7nDYVPCUAMveg60Az1XC6iVj44y/UZGa047k/xIiLZTwXgnEB/TuM5FAs+QObUqUKVhMNPQAAAABJRU5ErkJggg=='
		    });
		      
			//Add destionation pin
			map.addMarker({
		        lat: poiLatitude,
		        lng: poiLongitude,
		        icon: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAEZElEQVR4Xu2bwXFTMRCGP804Z0IFhArAMzxfEypAqSChAkgFQAVABSQVRFRAcrUzk1ABUAHOGWbELJEZxxPb2pX0nAO6ep9W+2v31+5KdvQ0xuzvOuIesBdh28HTedURrhx8B64i7mzE6XkfS3MtlVzid37DqwjewY5GV4TvDsIAPg4JAkyT0QSAS/z2L3jv4LDGqiMcb8HRkDCtMd/8HNUBGOMPHbwHtisvdhrhaEQ4rjlvVQDG+E+1dn2ZkeINI8LLWiBUASC5/JdFYqu1yMV5hDC34HmNkCgGoG/jZ2AICCPCsBTkYgD6cPuW4VAEwAT/mhvC29iI8LKEGM0ApDP+sgHba8GcDmBozRXMAIzxxw4OtKttIR/hZEQw5RwmANLufzMacx0hAGcp9SXeZIl7DjzwwDLvAB5bvMAEgHH3r4G3HeHDKgMTr7zVAmH1AhMAE/xPTexH+LoFPneHxngplCTEnii8YdoRHirk/4qqAbjA+winCkU/BvBUm7RIfvH7pjrMDgkH+88IEl7ZQw3AGP/BwatsDfC8I5wp5P+JTvBSPn/J/TbCxxFBjubsoQZgghdjdnM0WONyfm4l35x3BAEte1gA0MS/efdnFii9QM0DFgBiJrzXHaFKSTzBSx8giws6gsomlbAYPkE4MGuo3XHZrJqw+w/Afw+4PyGgJqQVIZBLvGreUXPAGC/t66wMLcJwRLjKYowlQpIVOpCqM2eoeUcNgIaQ+s4D+kqEpFB5k7MdIlPiBcrdF13q5ojaA7S1gLWBmXqNl5oLFUtJrAbA0gvQgiA6fsGpssv8oyOobp/EQ9UApGRIqrRHuWGQ5KYO9/oZpyervrtg/yASpWegyiIt8W8GQFmg3LJ3ducXcbfKVkeUFFN9hzg3uanuMHmAlgeUnmIRV5//MyUmAFIYZBcoFos035Qct2YASsJAY1yObMlRawbgvoSB9BtHhFuPLXJAKw6BgtNAs74c2aN1neZVk5g9QCY19AdzDNLIXA9gR9twnVdQBIAlKdJYt062hPyqhEAKg+wm6TqDtL9bUt9FHUUekABQta61Rq6Q/9wR5CqtaBQDsEEyNGV+1T0gkaE8jPpUtBW6j9WNj2XTV/GADXhBld2XdVcDID2Pa+4FpYlPkxCYTTrBW8pknfMX3DXepaiaB/TEBdViv1oesIhqYy+oFvvNAGjIBdV3vyoJznuCpnWuIIDqu98SgNrZYZWsrzkJLniB9PxeKHZ4qWiNnL95IrSooFalWKPiW7UJVY/BO04E1S3SHQstrvfXeWBTANJLL7kc1d4hzNb9riMIiM1GUwBk1QW9Q9NNjxap5gCkQsnSNGly7DWtBZahnwhRQiHroRPQJOnp9Ri8gxCz/1vQ8tjbiAfMlGZmiM2Jbx6EXjhgpjDjwYPpXbGW+DYGQCLEVblBL8S3UQBE+ZKHVs3y/Y1lgopToXnG13stsC4uF/5xVnS/t07XvfOAOVKUf4XsaJ+4lxi8+O0f+ACVUHPnE1EAAAAASUVORK5CYII='
		    });
		    
		    //Draw route 
		    map.drawRoute({
		        origin: [kioskLatitude, kioskLongitude],
		        destination: [poiLatitude, poiLongitude],
		        travelMode: 'walking',
		        strokeColor: '#cb0050', 
		        strokeOpacity: 1,
		        strokeWeight: 6
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
		
		VisualMap.prototype.SaveLocation = function (latitude,longitude) {
			
			var data = {
				'action': 		'set_kiosk_location',
				'latitude': 	latitude,
				'longitude': 	longitude
			};
	
			jQuery.post(ajaxurl, data, function(response) {
				
				response = jQuery.parseJSON( response ); 
				
				if ( response.json_result == true ) {
					console.log("Error, could not save location of this box."); 
				} else {
					console.log("Successfully saved location of this box."); 
				}
				
			});
		
		}
		
		VisualMap.prototype.GetLocation = function (poiLatitude, poiLongitude) {
			
			var data = {
				'action': 'get_kiosk_location'
			};
	
			jQuery.post(ajaxurl, data, function(response) {
				
				response = jQuery.parseJSON( response ); 
				
				if ( response.json_result == false ) {

					//Get and save new location 
					GMaps.geolocate({
						    
						success: function(position) {

							//Set location data 
							HbgKiosk.VisualMap.VisualMap.SaveLocation(position.coords.latitude, position.coords.longitude); 
							
							//Draw map 
							HbgKiosk.VisualMap.VisualMap.DrawMap(poiLatitude, poiLongitude, position.coords.latitude, position.coords.longitude ); 
							
						}
						
					});	
					
				} else {
					
					//Draw map
					HbgKiosk.VisualMap.VisualMap.DrawMap(poiLatitude, poiLongitude, response.kiosk_lat, response.kiosk_long ); 

				}
				
			});
			
		} 
	
		return new VisualMap();
		
	})(jQuery);