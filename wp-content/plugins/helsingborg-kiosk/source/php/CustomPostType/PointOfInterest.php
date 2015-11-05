<?php

namespace hbgKiosk\CustomPostType;

class PointOfInterest
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
        $icon = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE2LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPHBhdGggZD0iTTAsMjA4YzAsMjkuNzgxLDIwLjQzOCw1NC41OTQsNDgsNjEuNzVWNDgwSDE2Yy04LjgxMywwLTE2LDcuMTU2LTE2LDE2czcuMTg4LDE2LDE2LDE2aDQ4MGM4Ljg3NSwwLDE2LTcuMTU2LDE2LTE2DQoJCXMtNy4xMjUtMTYtMTYtMTZoLTMyVjI2OS43NWMyNy41NjItNy4xNTYsNDgtMzEuOTY5LDQ4LTYxLjc1di0xNkgwVjIwOHogTTMyMCwyNzJjMzUuMzc1LDAsNjQtMjguNjU2LDY0LTY0DQoJCWMwLDI5Ljc4MSwyMC40MzgsNTQuNTk0LDQ4LDYxLjc1VjQ4MEgxOTJWMjcyYzM1LjM3NSwwLDY0LTI4LjY1Niw2NC02NEMyNTYsMjQzLjM0NCwyODQuNjg4LDI3MiwzMjAsMjcyeiBNMTc2LDI2OS43NVY0ODBIODANCgkJVjI2OS43NWMyNy41NjMtNy4xNTYsNDgtMzEuOTY5LDQ4LTYxLjc1QzEyOCwyMzcuNzgxLDE0OC40MzgsMjYyLjU5NCwxNzYsMjY5Ljc1eiBNNDQ4LDQ4SDY0TDAsMTc2aDUxMkw0NDgsNDh6IE0xMzUuMTg4LDgzLjU2Mw0KCQlsLTMyLDY0Yy0xLjQzOCwyLjgxMy00LjI1LDQuNDM4LTcuMTg4LDQuNDM4Yy0xLjE4OCwwLTIuNDA2LTAuMjUtMy41NjMtMC44NDRjLTMuOTM4LTEuOTY5LTUuNTYzLTYuNzgxLTMuNTYzLTEwLjcxOWwzMi02NA0KCQljMi0zLjkzOCw2Ljc4MS01LjUzMSwxMC43MTktMy41OTRDMTM1LjU2Myw3NC44MTMsMTM3LjEyNSw3OS42MjUsMTM1LjE4OCw4My41NjN6IE0xOTkuMTg4LDgzLjU2M2wtMzIsNjQNCgkJYy0xLjQzOCwyLjgxMy00LjI1LDQuNDM4LTcuMTg4LDQuNDM4Yy0xLjE4OCwwLTIuNDA2LTAuMjUtMy41NjMtMC44NDRjLTMuOTM4LTEuOTY5LTUuNTYzLTYuNzgxLTMuNTYzLTEwLjcxOWwzMi02NA0KCQljMi0zLjkzOCw2LjgxMy01LjUzMSwxMC43MTktMy41OTRDMTk5LjU2Myw3NC44MTMsMjAxLjEyNSw3OS42MjUsMTk5LjE4OCw4My41NjN6IE0yNjQsMTQ0YzAsNC40MzgtMy41NjIsOC04LDgNCgkJYy00LjQwNiwwLTgtMy41NjMtOC04VjgwYzAtNC40MzgsMy41OTQtOCw4LThjNC40MzgsMCw4LDMuNTYzLDgsOFYxNDR6IE0zNTUuODc1LDE1MWMtMS4yNSwwLjY4OC0yLjU2MiwxLTMuODc1LDENCgkJYy0yLjgxMiwwLTUuNTYyLTEuNS03LTQuMTU2bC0zNS02NGMtMi4xMjUtMy44NzUtMC42ODgtOC43NSwzLjE4OC0xMC44NDRjMy44MTMtMi4xMjUsOC43NS0wLjc1LDEwLjg3NSwzLjE1NmwzNSw2NA0KCQlDMzYxLjEyNSwxNDQuMDMxLDM1OS43NSwxNDguOTA2LDM1NS44NzUsMTUxeiBNNDE5LjU2MiwxNTEuMTU2QzQxOC40MzgsMTUxLjc1LDQxNy4yNSwxNTIsNDE2LDE1Mg0KCQljLTIuOTM4LDAtNS43NS0xLjYyNS03LjEyNS00LjQzOGwtMzItNjRjLTItMy45MzgtMC4zNzUtOC43NSwzLjU2Mi0xMC43MTljMy44NzUtMS45NjksOC43NS0wLjM3NSwxMC43NSwzLjU5NGwzMiw2NA0KCQlDNDI1LjEyNSwxNDQuMzc1LDQyMy41NjIsMTQ5LjE4OCw0MTkuNTYyLDE1MS4xNTZ6IE0xMzYsMzg2LjQzOHYtMzYuODc1Yy00LjY4OC0yLjgxMi04LTcuNjg4LTgtMTMuNTYyYzAtOC44NDQsNy4xODgtMTYsMTYtMTYNCgkJYzguODc1LDAsMTYsNy4xNTYsMTYsMTZjMCw1Ljg3NS0zLjI4MSwxMC43NS04LDEzLjU2MnYzNi44NzVjNC43MTksMi44MTMsOCw3LjY4OCw4LDEzLjU2M2MwLDguODQ0LTcuMTI1LDE2LTE2LDE2DQoJCWMtOC44MTMsMC0xNi03LjE1Ni0xNi0xNkMxMjgsMzk0LjEyNSwxMzEuMzEzLDM4OS4yNSwxMzYsMzg2LjQzOHogTTY0LDE2YzAtOC44NDQsNy4xODgtMTYsMTYtMTZoMzUyYzguODc1LDAsMTYsNy4xNTYsMTYsMTYNCgkJcy03LjEyNSwxNi0xNiwxNkg4MEM3MS4xODgsMzIsNjQsMjQuODQ0LDY0LDE2eiBNMjgwLjQzOCwzNTcuNjU2bC0xMS4zMTItMTEuMzEzbDQ1LjI1LTQ1LjI1bDExLjMxMiwxMS4zMTNMMjgwLjQzOCwzNTcuNjU2eg0KCQkgTTI4MC40MzgsNDAyLjkwNmwtMTEuMzEyLTExLjMxM2w5MC41LTkwLjVsMTEuMzEyLDExLjMxM0wyODAuNDM4LDQwMi45MDZ6IE0zNTkuNjI1LDM0Ni4zNDRsMTEuMzEyLDExLjMxM2wtNDUuMjUsNDUuMjUNCgkJbC0xMS4zMTItMTEuMzEzTDM1OS42MjUsMzQ2LjM0NHoiLz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K';

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
            'has_archive'          => true,
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
            'supports'             => array('title', 'revisions', 'editor')
        );

        register_post_type('hbgKioskPOI', $args);
    }
}