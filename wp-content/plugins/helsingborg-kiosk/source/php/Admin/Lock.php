<?php

namespace HbgKiosk\Admin;

class Ban
{
    public function __construct()
    {
        add_filter('body_class', array($this, 'add_locked_post_css'), 100);
    }

    public function add_locked_post_css( $classes )
    {
	    
	    
	    
        if ( is_admin() ) {
	        
	        $post_id = get_the_id(); 
	        
	        if ( is_numeric( $post_id) && !empty( $post_id ) ) {
		        $cbis_post_id = get_post_meta($post->ID, 'poi-id', true); 
		        
		        if ( is_numeric($cbis_post_id) && !empty($cbis_post_id) ) 
	        } 
	        
	        
	        
        }
        
        return $classes; 
    }

}


