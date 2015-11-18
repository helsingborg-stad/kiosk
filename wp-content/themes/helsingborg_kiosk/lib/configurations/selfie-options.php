<?php 
	
	if( function_exists('acf_add_local_field_group') ):
	
	acf_add_local_field_group(array (
		'key' => 'group_564c939744d9d',
		'title' => 'Selfieinformation: Sidhuvud',
		'fields' => array (
			array (
				'key' => 'field_5649e89e97760',
				'label' => 'Titel på sidan',
				'name' => 'selfie_page_title',
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
				'key' => 'field_564c94bfa54c9',
				'label' => 'Underrubrik på sidan',
				'name' => 'selfie_page_subtitle',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_5649f1af7e957',
				'label' => 'Bild i sidhuvud',
				'name' => 'selfie_page_header_image',
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
					'value' => 'kiosk-selfie-settings',
				),
			),
		),
		'menu_order' => 5,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	
	acf_add_local_field_group(array (
		'key' => 'group_564c94b41e32e',
		'title' => 'Selfieinformation: Punktlista',
		'fields' => array (
			array (
				'key' => 'field_564c95081a808',
				'label' => 'Listobjekt',
				'name' => 'selfie_instructions',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => 'field_564c952c1a809',
				'min' => 1,
				'max' => 3,
				'layout' => 'block',
				'button_label' => 'Lägg till ny punkt',
				'sub_fields' => array (
					array (
						'key' => 'field_564c952c1a809',
						'label' => 'Punktens titel',
						'name' => 'instr_title',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
					array (
						'key' => 'field_564c953f1a80a',
						'label' => 'Punktens beskrivning',
						'name' => 'instr_text',
						'type' => 'textarea',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => 4,
						'new_lines' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
				),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'kiosk-selfie-settings',
				),
			),
		),
		'menu_order' => 10,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	
	endif;