<?php 
	
	//Remove admin panels 
	add_action( 'admin_menu', function (){
		remove_menu_page( 'edit.php' );
		remove_menu_page( 'upload.php' ); 
		remove_menu_page( 'edit.php?post_type=page' );
		remove_menu_page( 'edit-comments.php' ); 
		remove_menu_page( 'tools.php' );
	}, 999 );
	
	//Remove dault widgets 
	add_action('wp_dashboard_setup', function () {
	
		global $wp_meta_boxes;
		
		// Remove wordpress dashboards 
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
		
	}, 999 );
	
	//Add welcome widgets 
	add_action( 'wp_dashboard_setup', function () {
		wp_add_dashboard_widget(
            'welcome_dashboard_widget',        	 	// Widget slug.
            'Helsingborg Kiosk Admin',       	  	// Title.
            'welcome_dashboard_widget_function' 	// Display function.
        );	
	});

	function welcome_dashboard_widget_function() {
		echo "Välkommen till administrationen för Helsingborgs Stad kiosker."; 
	}
	
	//Add notice on admin panel for points
	add_action( 'admin_notices', function () {
		if ( isset( $_GET['post_type'] ) && $_GET['post_type'] == "hbgkioskpoi" ) {
		    echo '<div class="updated" style="padding: 10px;">'; 
		    	_e("Denna data hanteras i första hand av CBIS. Information som sparas här kommer att skrivas över av systemet när uppdatering sker i CBIS. Det kan ta en stund innan ny information når kiosksystemet från CBIS."); 
		    echo '</div>'; 
	    }
	});
	
	//Hide add new post button 
	add_action('admin_head', function() {
		
		if ( !current_user_can('administrator') ) {
			echo '
				<style>
					a[href$="post-new.php?post_type=hbgkioskpoi"] {display: none !important;}
				</style>		
			'; 
		} 
	}); 
	
	//Remove roles  
	add_action('admin_init', function() {
		remove_role('subscriber');
		remove_role('contributor'); 
		remove_role('author'); 
	});