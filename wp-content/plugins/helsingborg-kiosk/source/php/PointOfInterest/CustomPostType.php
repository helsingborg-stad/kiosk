<?php

namespace HbgKiosk\PointOfInterest;

use HbgKiosk\PointOfInterest\ParseCbis;

class CustomPostType
{
    public function __construct()
    {
        // Register the post type
        add_action('init', array($this, 'registerPostType'));

        add_action('init', array($this, 'registerTaxonomy'));

        // Add admin pages
        add_action('admin_menu', array($this, 'createParsePage'), 100);
    }

    /**
     * Registers the custom post type
     * @return void
     */
    public function registerPostType()
    {
        $icon = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE2LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPHBhdGggZD0iTTI1NiwwQzE2Ny42MzQsMCw5Niw3MS42MzQsOTYsMTYwYzAsMTYwLDE2MCwzNTIsMTYwLDM1MnMxNjAtMTkyLDE2MC0zNTJDNDE2LDcxLjYzNCwzNDQuMzY1LDAsMjU2LDB6IE0yNTYsMjU4DQoJCWMtNTQuMTI0LDAtOTgtNDMuODc2LTk4LTk4czQzLjg3Ni05OCw5OC05OGM1NC4xMjMsMCw5OCw0My44NzYsOTgsOThTMzEwLjEyMywyNTgsMjU2LDI1OHogTTE5NCwxNjBjMCwzNC4yNDIsMjcuNzU4LDYyLDYyLDYyDQoJCXM2Mi0yNy43NTgsNjItNjJzLTI3Ljc1OC02Mi02Mi02MlMxOTQsMTI1Ljc1OCwxOTQsMTYweiIvPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=';

        $labels = array(
            'name'               => _x('Intressepunkter', 'post type name'),
            'singular_name'      => _x('Intressepunkt', 'post type singular name'),
            'menu_name'          => __('Intressepunkter'),
            'add_new'            => __('Lägg till ny intressepunkt'),
            'add_new_item'       => __('Lägg till intressepunkt'),
            'edit_item'          => __('Redigera intressepunkt'),
            'new_item'           => __('Nytt intressepunkt'),
            'all_items'          => __('Alla intressepunkter'),
            'view_item'          => __('Visa intressepunkt'),
            'search_items'       => __('Sök intressepunkter'),
            'not_found'          => __('Inga intressepunkter att visa'),
            'not_found_in_trash' => __('Inga intressepunkter i papperskorgen')
        );

        $args = array(
            'labels'               => $labels,
            'description'          => 'Points of interest',
            'menu_icon'            => $icon,
            'public'               => true,
            'publicly_queriable'   => true,
            'show_ui'              => true,
            'show_in_nav_menus'    => true,
            'has_archive'          => true,
            'rewrite'              => array(
                'slug' => 'poi',
                'with_front' => false
            ),
            'exclude_from_search'  => false,
            'taxonomies'           => array('category'),
            'supports'             => array('title', 'revisions', 'editor')
        );

        register_post_type('hbgKioskPOI', $args);
    }

    public function registerTaxonomy()
    {
        $labels = array(
            'name'                       => _x('CBIS-kategorier', 'taxonomy general name'),
            'singular_name'              => _x('CBIS-kategori', 'taxonomy singular name'),
            'search_items'               => __('Söl CBIS-kategorier'),
            'popular_items'              => __('Populära CBIS-kategorier'),
            'all_items'                  => __('Alla CBIS-kategorier'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __('Redigera CBIS-kategori'),
            'update_item'                => __('Uppdatera CBIS-kategori'),
            'add_new_item'               => __('Lägg till ny CBIS-kategori'),
            'new_item_name'              => __('Ny CBIS-kategori'),
            'separate_items_with_commas' => __('Separera CBIS-kategorier med kommatecken'),
            'add_or_remove_items'        => __('Lägg till eller ta bort CBIS-kategorier'),
            'choose_from_most_used'      => __('Välj bland de mest använda CBIS-kategorierna'),
            'not_found'                  => __('Inga CBIS-kategorier hittades'),
            'menu_name'                  => __('CBIS-kategorier'),
        );

        $args = array(
            'hierarchical'          => false,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => false,
            'query_var'             => true,
            'rewrite'               => array('slug' => 'cbis'),
        );

        register_taxonomy('cbisCategories', 'hbgkioskpoi', $args);
    }

    /**
     * Creates a admin page to trigger update data function
     * @return void
     */
    public function createParsePage()
    {
        add_submenu_page(
            'edit.php?post_type=hbgkioskpoi',
            'Uppdatera data',
            'Uppdatera data',
            'edit_posts',
            'hbgKioskPOIGetNew',
            array($this, 'pageGetNewData')
        );
    }

    /**
     * Contents of the parse page
     * @return void
     */
    public function pageGetNewData()
    {
        //new ParseCbis( plugin_dir_path( __DIR__ ) . '../../data/CSV_CBIS_Sync_Export.csv');
        new ParseCbis('http://familjenhelsingborg.se/cbisexport.csv');
    }

    /**
     * Get poi:s
     * @param  integer $count     Number of POI to get
     * @param  array   $metaQuery Optional meta query array
     * @return object             Object with POI posts
     */
    public static function get($count = 10, $metaQuery = null, $includeDrafts = false)
    {
        $args = array(
            'posts_per_page' => $count,
            'post_type'      => 'hbgKioskPOI',
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC'
        );

        if ($includeDrafts) {
            $args['post_status'] = array('publish', 'draft');
        }

        if (is_array($metaQuery)) {
            $args['meta_query'] = $metaQuery;
        }

        $posts = get_posts($args);

        return $posts;
    }
}
