	var HbgKiosk; HbgKiosk = HbgKiosk || {};

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

	// { "cellAlign": "left", "contain": true, "wrapAround": true, "prevNextButtons": false, "cellSelector": ".list-item" }
	//
	var flickity = null;
	jQuery(function(){
		flickity = jQuery('.flickity-swipe').flickity({
			"cellAlign": "left",
			"contain": true,
			"wrapAround": true,
			"prevNextButtons": false,
			"cellSelector": ".list-item"
		});
	});

