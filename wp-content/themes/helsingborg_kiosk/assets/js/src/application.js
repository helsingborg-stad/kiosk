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
				cellAlign: "center",
				contain: true,
				wrapAround: true,
				prevNextButtons: true,
				cellSelector: ".list-item",
				draggable: false,
				pageDots: true
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
		
		var eventList = jQuery(".event-list"); 
		var eventItem = jQuery(this); 


		if ($(this).hasClass('event-item-open')) {
			
			// CLOSE
			$(this).removeClass('event-item-open');

			$('#center-button').show();
			$('#center-button-exit-event').hide();

			$('[data-joystick]').show();
			
			$('#event-backdrop').fadeOut(300);
			
			$(this).blur();
			
		} else {
			
			// OPEN
			eventItem.addClass('event-item-open');
			
			$('#center-button-select, #center-button').hide();
			$('#center-button-exit-event').show();

			$('[data-joystick]').hide();
			
			$('#event-backdrop').fadeIn(300);

			$(this).blur();
		}
	});

	$('.post-type-archive-hbgkioskevent #center-button-exit-event, .post-type-archive-hbgkioskevent header, .post-type-archive-hbgkioskevent #hero,  .post-type-archive-hbgkioskevent #event-backdrop').on('click', function (e) {
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

