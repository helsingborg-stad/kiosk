<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
    'key' => 'group_5641bb3103c6a',
    'title' => 'POI Category',
    'fields' => array (
        array (
            'key' => 'field_5641bb373f6f4',
            'label' => 'Ikon',
            'name' => 'poi-category-icon',
            'type' => 'image',
            'instructions' => 'Måste vara av filtyp .svg',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => 'svg',
        ),
        array (
            'key' => 'field_5641c3a96624f',
            'label' => 'Bakgrundsbild',
            'name' => 'poi-category-bg',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
        ),
        array (
            'key' => 'field_5641cdb910324',
            'label' => 'Inkludera CBIS-kategorier',
            'name' => 'poi-category-map',
            'type' => 'taxonomy',
            'instructions' => 'Ange de kategorier från CBIS-datan som ska inkluderas i denna kategori',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'taxonomy' => 'cbisCategories',
            'field_type' => 'checkbox',
            'allow_null' => 1,
            'add_term' => 0,
            'save_terms' => 0,
            'load_terms' => 0,
            'return_format' => 'object',
            'multiple' => 0,
        ),
        array (
            'key' => 'field_5645a09829af1',
            'label' => 'Maximalt avstånd till intressepunkt',
            'name' => 'poi-category-max-distance',
            'type' => 'select',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array (
                -1 => 'Visa alla',
                0 => 'I närheten',
                1 => '1 km',
                2 => '2 km',
                3 => '3 km',
                4 => '4 km',
                5 => '5 km',
                6 => '6 km',
                7 => '7 km',
                8 => '8 km',
                9 => '9 km',
                10 => '10 km',
                15 => '15 km',
                20 => '20 km',
                25 => '25 km',
                30 => '30 km',
                35 => '35 km',
                40 => '40 km',
                45 => '45 km',
                50 => '50 km',
                55 => '55 km',
                60 => '60 km',
                65 => '65 km',
                70 => '70 km',
                75 => '75 km',
                80 => '80 km',
                85 => '85 km',
                90 => '90 km',
                95 => '95 km',
                100 => '100 km',
                
            ),
            'other_choice' => 0,
            'save_other_choice' => 0,
            'default_value' => array (
                -1 => -1,
            ),
            'layout' => 'vertical',
            'multiple' => 0,
            'allow_null' => 0,
            'ui' => 0,
            'ajax' => 0,
            'placeholder' => '',
            'disabled' => 0,
            'readonly' => 0,
        ),
    ),
    'location' => array (
        array (
            array (
                'param' => 'taxonomy',
                'operator' => '==',
                'value' => 'category',
            ),
        )
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));

endif;