<?php

namespace HbgKiosk\Event;

class CustomPostType
{
    public function __construct()
    {
        // Register the post type
        add_action('init', array($this, 'registerPostType'));
    }

    /**
     * Registers the custom post type
     * @return void
     */
    public function registerPostType()
    {

        $labels = array(
            'name'               => _x('Evenemang', 'post type name'),
            'singular_name'      => _x('Evenemang', 'post type singular name'),
            'menu_name'          => __('Evenemang'),
            'add_new'            => __('Lägg till nytt evenemang'),
            'add_new_item'       => __('Lägg till evenemang'),
            'edit_item'          => __('Redigera evenemang'),
            'new_item'           => __('Nytt evenemang'),
            'all_items'          => __('Alla evenemang'),
            'view_item'          => __('Visa evenemang'),
            'search_items'       => __('Sök evenemang'),
            'not_found'          => __('Inga evenemang att visa'),
            'not_found_in_trash' => __('Inga evenemang i papperskorgen')
        );

        $args = array(
            'labels'               => $labels,
            'description'          => 'Events',
            'public'               => true,
            'publicly_queriable'   => true,
            'show_ui'              => false,
            'show_in_nav_menus'    => false,
            'has_archive'          => true,
            'rewrite'              => array(
                'slug' => 'event',
                'with_front' => false
            ),
            'exclude_from_search'  => true
        );

        register_post_type('hbgKioskEvent', $args);
    }
}