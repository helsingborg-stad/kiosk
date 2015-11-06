	var HbgKiosk;
	
	jQuery(function(){
		jQuery(".show-event-modal").click(function(){
			jQuery('#event-modal').modal();
		});
	});
	
	jQuery(function(){
		//jQuery('#event-modal').modal();
	}); 

	/****************************************************
	 *
	 *	GOOGLE MAPS API 
	 *
	 ****************************************************/
	
	var geocoder;
	var map;
	function initialize() {
	  geocoder = new google.maps.Geocoder();
	  var latlng = new google.maps.LatLng(-34.397, 150.644);
	  var mapOptions = {
	    zoom: 12,
	    center: latlng,
	    disableDefaultUI: true, 
	  }
	  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	}
	
	function codeAddress() {
	  var address = document.getElementById('address').value;
	  geocoder.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	      map.setCenter(results[0].geometry.location);
	      var marker = new google.maps.Marker({
	          map: map,
	          position: results[0].geometry.location
	      });
	    } else {
	      alert('Geocode was not successful for the following reason: ' + status);
	    }
	  });
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);