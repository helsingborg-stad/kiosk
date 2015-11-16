<?php
	
	/*******************************************************
	 *
	 *	SCRIPT REGISTERS
	 *
	 ******************************************************/

	//Register styles & scripts
	add_action( 'wp_enqueue_scripts', function() {
		
		//Styles
		wp_enqueue_style ( 'reset'				, CSSURL."/app.min.css", 							array(), ASSET_VERSION );

		//Scripts (Remote)			
		wp_enqueue_script( 'gmaps'				, "http://maps.googleapis.com/maps/api/js", 		array(), "", true );

		//Scripts (Local)			
		wp_enqueue_script( 'application'		, JSURL."/app.min.js", 								array(), ASSET_VERSION, true );
		
	});
	
	//Register admin styles 
	add_action('admin_enqueue_scripts', function() {
		
		//Enque admin css 
		wp_enqueue_style( 'admin-app'			, CDNURL."/css/dist/admin.min.css", 				array(), ASSET_VERSION );
		
	});
	
	//Deque styles
	add_action( 'wp_print_styles', function(){
		wp_dequeue_style('stylesheet');
	}, 100 );