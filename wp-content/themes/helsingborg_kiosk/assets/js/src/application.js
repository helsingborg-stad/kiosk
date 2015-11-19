	var HbgKiosk; HbgKiosk = HbgKiosk || {};

	/****************************************************
	 *
	 *	Fastclick.js init
	 *
	 ****************************************************/

	$(function() {
	    FastClick.attach(document.body);
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
			event.preventDefault();
			window.history.back();
		});
	});

	var flickity = null;
	if (jQuery('.flickity-swipe').length > 0) {
		jQuery(function(){
			flickity = jQuery('.flickity-swipe').flickity({
				cellAlign: "left",
				contain: true,
				wrapAround: true,
				prevNextButtons: true,
				cellSelector: ".list-item",
				draggable: false
			});
		});
	}

	/****************************************************
	 *
	 *	Event item modal
	 *
	 ****************************************************/

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
			$(".event-inner",this).addClass('animated zoomIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
				$(this).removeClass("animated zoomIn");
			});

			$('.event-backdrop').fadeIn(200);

			$('#center-button-select, #center-button').hide();
			$('#center-button-exit-event').show();

			$('[data-joystick]').hide();

			$(this).blur();
		}
	});

	$('.post-type-archive-hbgkioskevent #center-button-exit-event, .post-type-archive-hbgkioskevent .event-backdrop, .post-type-archive-hbgkioskevent header, .post-type-archive-hbgkioskevent #hero').on('click', function (e) {
		e.preventDefault();
		$('.event-item-open').trigger('click');
	});

	/****************************************************
	 *
	 *	Single
	 *
	 ****************************************************/

	if ($('.scroll-wrapper').length > 0 && $('.scroll-wrapper').get(0).scrollHeight > $('.scroll-wrapper').get(0).clientHeight) {
		$('.nav-scroll').show();
	}

	$('[data-action="scroll-down"]').on('click', function (e) {
		e.preventDefault();
		var selector = $(this).data('selector');
		var scrollPos = $('.scroll-wrapper').scrollTop();
		$(selector).animate({
			scrollTop: scrollPos + 200
		}, 200);
	});

	$('[data-action="scroll-up"]').on('click', function (e) {
		e.preventDefault();
		var selector = $(this).data('selector');
		var scrollPos = $('.scroll-wrapper').scrollTop();
		$(selector).animate({
			scrollTop: scrollPos - 200
		}, 200);
	});

