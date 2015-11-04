<?php
	
	//Navigation
	add_action( 'after_setup_theme',function() {
	//	register_nav_menu( 'main-menu', __( 'Main Menu', 'main-menu' ) );
	});
	
	//Pre next linking
	add_filter('next_posts_link_attributes', 'posts_link_attributes');
	add_filter('previous_posts_link_attributes', 'posts_link_attributes');
	function posts_link_attributes() {
	    return 'class="button"';
	}

	//Default image setting 
	add_action('pre_option_image_default_link_type', function() {
		return 'none';
	});
	
	//No emojis! 
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	
	//No posts function
	add_action( 'admin_menu', 'remove_admin_menus' );
	add_action( 'wp_before_admin_bar_render', 'remove_toolbar_menus' );
	add_action( 'wp_dashboard_setup', 'theme_remove_dashboard_widgets' );
	
	function remove_admin_menus() {
	    remove_menu_page( 'edit.php' );
	}
	
	function remove_toolbar_menus() {
	    global $wp_admin_bar;
	    $wp_admin_bar->remove_menu( 'new-post' ); 
	}
	
	function theme_remove_dashboard_widgets() {
	    global $wp_meta_boxes;
	    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	}