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
			event.preventDefault();
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

	$('.event-list .event-item').on('click', function (e) {
		e.preventDefault();

		if ($(this).hasClass('event-item-open')) {
			// CLOSE
			$(this).removeClass('event-item-open');
			$('.event-backdrop').fadeOut(200);

			$('#center-button').show();
			$('#center-button-exit-event').hide();

			$('[data-joystick]').show();

			$(this).blur();
		} else {
			// OPEN
			$(this).addClass('event-item-open');
			$('.event-backdrop').fadeIn(200);

			$('#center-button-select, #center-button').hide();
			$('#center-button-exit-event').show();

			$('[data-joystick]').hide();

			$(this).blur();
		}
	});

	$('#center-button-exit-event').on('click', function (e) {
		e.preventDefault();
		$('.event-item-open').trigger('click');
	});

	$('.event-backdrop').on('click', function (e) {
		e.preventDefault();
		$('.event-item-open').trigger('click');
	});

