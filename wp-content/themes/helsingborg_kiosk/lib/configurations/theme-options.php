<?php 
	
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_5649e896350bd',
	'title' => 'Generella inställningar',
	'fields' => array (
		array (
			'key' => 'field_5649e89e97760',
			'label' => 'Titel på startsida',
			'name' => 'front_page_title',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Vad vill du göra idag?',
			'placeholder' => 'Ange en titel för startsidan...',
			'prepend' => '',
			'append' => '',
			'maxlength' => 100,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5649f1af7e957',
			'label' => 'Bild i sidhuvud',
			'name' => 'front_page_header_image',
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
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => 'png,jpg,jpeg',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'kiosk-general-settings',
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