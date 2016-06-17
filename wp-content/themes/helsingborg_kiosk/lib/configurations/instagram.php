<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
    'key' => 'group_575ab20bde493',
    'title' => 'Instagramfeedinställningar',
    'fields' => array (
        array (
            'key' => 'field_5763e3be2bdc5',
            'label' => 'Instagram Client ID',
            'name' => 'instagram_client_id',
            'type' => 'text',
            'instructions' => 'Du måste ha tillgång till instagramkontot du vill hämta ifrån. Var noga med att logga in med detta konto när du klickar på länken "skapa en till mig". ',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '<a target="_blank" href="http://instagram.pixelunion.net/">Skapa en till mig</a>',
            'maxlength' => '',
            'readonly' => 0,
            'disabled' => 0,
        ),
    ),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'hbgkioskfeed',
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
