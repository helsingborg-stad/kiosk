<?php 
	
	add_action('wp_head',function(){
		if(!is_admin())
			echo "<script> var ajaxurl = '".admin_url('admin-ajax.php')."';</script>"; 
	});