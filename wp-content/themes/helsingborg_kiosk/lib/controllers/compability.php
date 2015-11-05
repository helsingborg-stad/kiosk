<?php 
	
	add_action('send_headers',function(){
		header( 'X-UA-Compatible: IE=edge,chrome=1' );
	}); 
	
	add_filter('show_admin_bar', '__return_false');