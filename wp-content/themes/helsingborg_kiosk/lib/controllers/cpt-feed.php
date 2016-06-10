<?php

	add_action('init', function ()
    {

        $labels = array(
            'name'               => _x('Instagramfeed', 'post type name'),
            'singular_name'      => _x('instagramfeed', 'post type singular name'),
            'menu_name'          => __('instagramfeed'),
            'add_new'            => __('Lägg till nytt instagramfeed'),
            'add_new_item'       => __('Lägg till instagramfeed'),
            'edit_item'          => __('Redigera instagramfeed'),
            'new_item'           => __('Nytt instagramfeed'),
            'all_items'          => __('Alla instagramfeed'),
            'view_item'          => __('Visa instagramfeed'),
            'search_items'       => __('Sök instagramfeed'),
            'not_found'          => __('Inga instagramfeed att visa'),
            'not_found_in_trash' => __('Inga instagramfeed i papperskorgen')
        );

        $args = array(
            'labels'               => $labels,
            'description'          => 'Instagram Feed',
            'public'               => true,
            'publicly_queriable'   => true,
            'show_ui'              => true,
            'show_in_nav_menus'    => true,
            'has_archive'          => true,
            'menu_position'        => 900,
            'rewrite'              => array(
                'slug' => 'instagramfeed',
                'with_front' => false
            ),
            'exclude_from_search'  => true
        );

        register_post_type('hbgKioskFeed', $args);

    });
