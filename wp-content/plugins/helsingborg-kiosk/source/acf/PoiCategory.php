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
    ),
    'location' => array (
        array (
            array (
                'param' => 'taxonomy',
                'operator' => '==',
                'value' => 'category',
            ),
        ),
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'hbgkioskpoi',
            ),
        ),
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