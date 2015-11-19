
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
				if (poiLatitude != "" && poiLongitude != "") {
					//Set default location
					map = new GMaps({
				        div: '#map-canvas',
				        lat: poiLatitude,
				        lng: poiLongitude,
				        mapTypeControl: false
				    });

					//Get location from db or maps
					HbgKiosk.VisualMap.VisualMap.GetLocation(poiLatitude, poiLongitude);

		        }

	        }

	    };

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
		        icon: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAE/UlEQVR4Xu2by3HcRhCGP7Cos+UITEVgssrYq+QINIzAYgQSIxAVgaQIREegYQSmrwtXcR2BxAhMnqUyXC0OVFgsMJhHD/ZiXBfo6fnn7/dsxULPGnNcwXPguIWjCo77S7ewqeAzsGnhaoXdLKFaVXKRG8zRV3jZgqngKGatFj5XYA/h/QlWgCnyFAHgBvP4C7yt4IWG1i1cPoLzE+ydhry+DHUA/sKYFj4Aj5WVvavg7Bes1ZSrCsAa80Hr1Kc2KWxYYc+0QFABQCj/9eHUjZZiM3LEN5xpmIQKAA3m44Kb77CxNfY0F/BsADJofy8hz21AQuIPsZtp4f0K+yr2OzUn6ByenH7Q08LvB2CnHJnI+/chZP4WJBCo4DTHMSYzwNn9pxBvLxt/BBeh8Vzyhy9wEQjE3SE8SfUHyQCsMZchCrZwtsJehp5o/7015kX14Fy9jwC8wiblHEkAuAxPTn9OsZPclNal0DdzazkWRGeMSQCsMe8qeOlTynfyDafPoX0mdYGTsYHquubj1ZjMECakOsRUAD75cvspSjonJynyaF0g+f8BnI85tTmTk29X2CdzTBn+Hg1ACCXH6Bhyip1yY+wJMbsWok0uGoAGcwG89qSqOw4pNlyK7LHwNscC4LzGvothQQoAUoxIXT/6TCjuNZkxQWOUDgDyqsZGpePRAKwxN8NmRn8DNXZLZoDSkwc2BNPlHv942LdZYU9KM6D1LHBfY7fK4JCI4dnQTqrbYKQnMJk2Dw9gDoxoBjRIuT/5/FljJbx9fxrMNfB0TpGJ36Pl/Q/AwATngNdmwF2N/bG/aAETEB8w2W0qzoA1Rrq3P08hu08nCOyYTAkGeG16LAw2GMnRf5pTZvD7bY3dyhgDIsoiAHjzgLE0OEDxHWwSE6HyecBcJig72VcqDLypsZKpBj/RTjDkNH3FUAuSqk6Zw20Fr1KKIdlxSncoGoCQYkiU8ZXDrip81mWUMhY7gOup1lZoIbVIMSSbm8vGOv6lKDTkbijgwE4WGmIH0QxwAHgdYX/hJVpibr1oB+jMJgSn7XcajLSi34Z+6WZ7byKboq9jpkypQCcxIKQ5MQaOAFFR2bHW10OlVz1taaUtHt3gXLQnKJubywgD2CFVXX8wkjxMbeHvFXbrvkHA+t9eSWKA8wNRZhCqUOJ70Z2gbp1kAFLNIHGD3s9S6Z/FACUzyMYjh/4aAARNbrJ36RGQ6v2zTUAEuB6dVHrRk10lUO4P4Sh1LpjNAGcGQTNCpQ1vicmZCaowwLFAboLNzglLAJDj/NQAcCExp/GZik1S6jtcLDkM9gU1GOkE/5G6k8Tvfq2xAnzWowLAHlgQ3fqaQkkTgCVZoHL6KlFgYApL+AK10y8BwBIsUDt9dQAW8AUqnr/PWjUf0AktWSRpxP0iYXAoNGccNuWtU+8AzcVIdQa47FDuDmvWCNk5f/EwOMICtUoxt+LzsaAIA7oFM+8GdGJUw94iPqBbJKKnP3lIGrOFvTHAhUXvrbIZJxU965tzeosyoGcKKuPx2M2FvF/UB/QASMkQVTO+xaNAZm5QnPqdfoswoOcUvddr5L3cLm8I7Yumwj4FQqJCaa+/FyfYX3RmsJo84Yk9+b2YQM8pjo3X1Su9EFAW9QGdQm6eIIPR7qrM7SEc5/T3QzY79s5eABBF+v5gabvfmxMcCY3f7gGk/qkq9dT73/0Hy5MCX+FXX7UAAAAASUVORK5CYII='
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

		    //Zoom out more
		    map.zoomOut(1);

		};

		VisualMap.prototype.GetCookie = function (cname) {
		    var name = cname + "=";
		    var ca = document.cookie.split(';');
		    for(var i=0; i<ca.length; i++) {
		        var c = ca[i];
		        while (c.charAt(0)==' ') c = c.substring(1);
		        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
		    }
		    return "";
		};

		VisualMap.prototype.SetCookie = function(cname, cvalue, exdays) {
		    var d = new Date();
		    d.setTime(d.getTime() + (exdays*24*60*60*1000));
		    var expires = "expires="+d.toUTCString();
		    document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";
		};

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

		};

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

		};

		return new VisualMap();

	})(jQuery);