<?php 
	
	add_action('init', function ()
    {

        $labels = array(
            'name'               => _x('skärmsläckare', 'post type name'),
            'singular_name'      => _x('skärmsläckare', 'post type singular name'),
            'menu_name'          => __('skärmsläckare'),
            'add_new'            => __('Lägg till nytt skärmsläckare'),
            'add_new_item'       => __('Lägg till skärmsläckare'),
            'edit_item'          => __('Redigera skärmsläckare'),
            'new_item'           => __('Nytt skärmsläckare'),
            'all_items'          => __('Alla skärmsläckare'),
            'view_item'          => __('Visa skärmsläckare'),
            'search_items'       => __('Sök skärmsläckare'),
            'not_found'          => __('Inga skärmsläckare att visa'),
            'not_found_in_trash' => __('Inga skärmsläckare i papperskorgen')
        );

        $args = array(
            'labels'               => $labels,
            'description'          => 'Screensaver',
            'public'               => true,
            'publicly_queriable'   => true,
            'show_ui'              => false,
            'show_in_nav_menus'    => false,
            'has_archive'          => true,
            'rewrite'              => array(
                'slug' => 'screensaver',
                'with_front' => false
            ),
            'exclude_from_search'  => true
        );

        register_post_type('hbgKioskScreensaver', $args);
    
    });