<?php

namespace HbgSocialMedia\Admin;

class Panel
{
    public function __construct()
    {
		add_action('init', array($this,'register_options_page') );
		
		add_action('init', array($this,'register_twitter_fields') );
		add_action('init', array($this,'register_instagram_fields') );
		add_action('init', array($this,'register_facebook_fields') );
    }
    
    public function register_twitter_fields() 
    {
		if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array (
			'key' => 'group_564b1ebce9a0b',
			'title' => 'Twitter API',
			'fields' => array (
				array (
					'key' => 'field_564b1f2e11778',
					'label' => 'Nyckel',
					'name' => 'twitter_key',
					'type' => 'text',
					'instructions' => 'Kallas "consumer key"',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '33,333',
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
					'key' => 'field_564b1f513700a',
					'label' => 'Hemlig nyckel',
					'name' => 'twitter_key_secret',
					'type' => 'text',
					'instructions' => 'Kallas "consumer secret"',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '33,333',
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
					'key' => 'field_564b1f9244486',
					'label' => 'Standard hashtag',
					'name' => 'twitter_default_hashtag',
					'type' => 'text',
					'instructions' => 'Används om inget annat definieras i modulen',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '33,333',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '#',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'social-media-settings',
					),
				),
			),
			'menu_order' => 10,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'field',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
		
		endif;
		
    }
    
    public function register_instagram_fields() 
    {
	    
	    if( function_exists('acf_add_local_field_group') ):
		
		acf_add_local_field_group(array (
			'key' => 'group_564b209b9c9ca',
			'title' => 'Instagram API',
			'fields' => array (
				array (
					'key' => 'field_564b209ba0e56',
					'label' => 'Hemlig nyckel',
					'name' => 'instagram_key_secret',
					'type' => 'text',
					'instructions' => 'Kallas "client id"',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '33,333',
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
					'key' => 'field_564b209ba0e69',
					'label' => 'Standard hashtag',
					'name' => 'instagram_default_hashtag',
					'type' => 'text',
					'instructions' => 'Används om inget annat definieras i modulen',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '33,333',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '#',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'social-media-settings',
					),
				),
			),
			'menu_order' => 30,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'field',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
		
		endif;
		
    }
    
    public function register_facebook_fields() 
    {
	    
	    if( function_exists('acf_add_local_field_group') ):
		
		acf_add_local_field_group(array (
			'key' => 'group_564b209904a99',
			'title' => 'Facebook API',
			'fields' => array (
				array (
					'key' => 'field_564b209908e5c',
					'label' => 'Nyckel',
					'name' => 'facebook_app_id',
					'type' => 'text',
					'instructions' => 'Kallas "app id"',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '33,333',
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
					'key' => 'field_564b209908e70',
					'label' => 'Hemlig nyckel',
					'name' => 'facebook_key_secret',
					'type' => 'text',
					'instructions' => 'Kallas "app secret"',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '33,333',
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
					'key' => 'field_564b209908e7f',
					'label' => 'Standard hashtag',
					'name' => 'facebook_default_hashtag',
					'type' => 'text',
					'instructions' => 'Används om inget annat definieras i modulen',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '33,333',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '#',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'social-media-settings',
					),
				),
			),
			'menu_order' => 20,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'field',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
		
		endif;
		
    }
    
    public function register_options_page() 
    {
	    
	   if (function_exists('acf_add_options_page')) {
	
			acf_add_options_page(array(
				'page_title' 	=> __("Inställningar för sociala medier",'hbg-social-media'),
				'menu_title'	=> __("Sociala medier",'hbg-social-media'),
				'menu_slug' 	=> 'social-media-settings',
				'capability'	=> 'administrator',
				'redirect'		=> false,
				'icon_url'		=> 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDYxMiA2MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDYxMiA2MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48Zz48Zz48cGF0aCBkPSJNNjEyLDI1MS4xNzZjMC0xMTcuMjc4LTExMy43NzUtMjEyLjY4OS0yNTMuNjE3LTIxMi42ODljLTEzOS44NDYsMC0yNTMuNjIsOTUuNDEyLTI1My42MiwyMTIuNjg5czExMy43NzQsMjEyLjY4OSwyNTMuNjIsMjEyLjY4OWMxMS43NTgsMCwyMy41NTctMC42ODEsMzUuMTU3LTIuMDI1YzUzLjg2NCwzNC4yMTgsOTMuNjI3LDUyLjk0NywxMTguMjcyLDU1LjY4NWMwLjg1NywwLjA5MywxLjcyLDAuMTQxLDIuNTY1LDAuMTQxYzcuOTE2LDAsMTUuMjQzLTMuOTQ1LDE5LjYwNi0xMC41NmM0Ljg3Ny03LjQsNS4xOTUtMTYuNzg4LDAuODUxLTI0LjQ1M2MtMC4yMDItMC4zNjUtMTkuMjIxLTM1LjA2NS0xMy43MzQtNjguMjExQzU3OC45NjIsMzczLjk1LDYxMiwzMTQuNzc2LDYxMiwyNTEuMTc2eiBNMjg5LjUwNSwyODMuMjk4Yy0yMC43NTEsMC0zNy41NjgtMTYuODIxLTM3LjU2OC0zNy41NjljMC0yMC43NDksMTYuODE3LTM3LjU2OSwzNy41NjgtMzcuNTY5YzIwLjc0NywwLDM3LjU3MSwxNi44MjEsMzcuNTcxLDM3LjU2OUMzMjcuMDc3LDI2Ni40NzcsMzEwLjI1MywyODMuMjk4LDI4OS41MDUsMjgzLjI5OHogTTQyNy4yNjYsMjgzLjI5OGMtMjAuNzU0LDAtMzcuNTc1LTE2LjgyMS0zNy41NzUtMzcuNTY5YzAtMjAuNzQ5LDE2LjgyMS0zNy41NjksMzcuNTc1LTM3LjU2OWMyMC43NDcsMCwzNy41NjgsMTYuODIxLDM3LjU2OCwzNy41NjlDNDY0LjgzNCwyNjYuNDc3LDQ0OC4wMTIsMjgzLjI5OCw0MjcuMjY2LDI4My4yOTh6Ii8+PHBhdGggZD0iTTE1OC4zNDMsNDIxLjM0MmMtMjUuMTY1LTIwLjgzNy00NS4wMDItNDUuMjI4LTU4Ljk1Mi03Mi40OTJjLTE0LjcwOS0yOC43NDUtMjIuMTY2LTU5LjMyMy0yMi4xNjYtOTAuODgzYzAtMzEuNTYxLDcuNDU4LTYyLjEzOCwyMi4xNjYtOTAuODgzYzEuMTI2LTIuMiwyLjMwNS00LjM3MywzLjUwNi02LjUzNkM0MC43OCwxOTYuMTM2LDAsMjU1LjUzMiwwLDMyMi42NzVjMCw2MC4zMjMsMzIuNDk1LDExNi4yNTMsODkuMjY0LDE1My44NzVjMTAuNDg1LDQxLjIxOS0xMy44NDYsODQuODI4LTE0LjEwMyw4NS4yNzRjLTEuNDUsMi41NTctMS4zNDMsNS43MTMsMC4yNzUsOC4xNjdjMS40NTgsMi4yMTIsMy45MiwzLjUyMSw2LjUzMywzLjUyMWMwLjI4OSwwLDAuNTc3LTAuMDE3LDAuODY5LTAuMDQ5YzI4LjQwMi0zLjE1NCw3OC40MTctMzIuMDIxLDExNi4zMDctNTYuMzYxYzEyLjc2MSwxLjczMiwyNS44MDYsMi42MDgsMzguODIxLDIuNjA4YzQ5Ljc3NiwwLDk2LjAyMi0xMi43MjksMTM0LjI2NS0zNC40NDljLTguNTQ0LDAuNjg0LTE3LjE1LDEuMDQ5LTI1LjczLDEuMDQ5QzI3NS43NjYsNDg2LjMxLDIwOC45NDQsNDYzLjIzNywxNTguMzQzLDQyMS4zNDJ6Ii8+PC9nPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48L3N2Zz4='
			));
		
		}	
	    
    }

}