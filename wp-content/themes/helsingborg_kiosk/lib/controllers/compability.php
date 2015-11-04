<?php 
	
	add_action('send_headers',function(){
		header( 'X-UA-Compatible: IE=edge,chrome=1' );
	}); 