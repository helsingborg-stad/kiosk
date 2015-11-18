<?php

	add_action('init', function ()
    {

        $labels = array(
            'name'               => _x('selfie', 'post type name'),
            'singular_name'      => _x('selfie', 'post type singular name'),
            'menu_name'          => __('selfie'),
            'add_new'            => __('Lägg till nytt selfie'),
            'add_new_item'       => __('Lägg till selfie'),
            'edit_item'          => __('Redigera selfie'),
            'new_item'           => __('Nytt selfie'),
            'all_items'          => __('Alla selfie'),
            'view_item'          => __('Visa selfie'),
            'search_items'       => __('Sök selfie'),
            'not_found'          => __('Inga selfie att visa'),
            'not_found_in_trash' => __('Inga selfie i papperskorgen')
        );

        $args = array(
            'labels'               => $labels,
            'description'          => 'Selfie',
            'public'               => true,
            'publicly_queriable'   => true,
            'show_ui'              => false,
            'show_in_nav_menus'    => false,
            'has_archive'          => true,
            'rewrite'              => array(
                'slug' => 'selfie',
                'with_front' => false
            ),
            'exclude_from_search'  => true
        );

        register_post_type('hbgKioskSelfie', $args);

    });