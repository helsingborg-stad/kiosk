<?php
	
	/*******************************************************
	 *
	 *	SCRIPT REGISTERS
	 *
	 ******************************************************/

	//Register styles & scripts
	add_action( 'wp_enqueue_scripts', function() {
		
		//Styles
		wp_enqueue_style ( 'reset'				, CSSURL."/app.min.css", 	array(), ASSET_VERSION );

		//Scripts (Local)			
		wp_enqueue_script( 'application'		, JSURL."/app.min.js", 		array(), ASSET_VERSION, true );
		
	});

	//Deque styles
	add_action( 'wp_print_styles', function(){
		wp_dequeue_style('stylesheet');
	}, 100 );