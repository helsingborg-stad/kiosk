<?php 
	
	namespace HelsingborgKiosk\Locations;
	
	Class HelsingborgKioskLocation {
		
		public static $kiosk_ip; 
		
		function __construct() {
			
			//ID
			self::$kiosk_ip = $_SERVER['REMOTE_ADDR']; 
			
			//Hooks 
			add_action('init', 'HelsingborgKiosk\Locations\HelsingborgKioskLocation::register_options_page');
			
			//Ajax
			add_action( 'wp_ajax_get_kiosk_location', 'HelsingborgKiosk\Locations\HelsingborgKioskLocation::get_kiosk_location' );
			add_action( 'wp_ajax_nopriv_get_kiosk_location', 'HelsingborgKiosk\Locations\HelsingborgKioskLocation::get_kiosk_location' ); 
			
			add_action( 'wp_ajax_set_kiosk_location', 'HelsingborgKiosk\Locations\HelsingborgKioskLocation::set_kiosk_location' );
			add_action( 'wp_ajax_nopriv_set_kiosk_location', 'HelsingborgKiosk\Locations\HelsingborgKioskLocation::set_kiosk_location' ); 
			
		}
		
		public static function set_kiosk_location () {
			
			//Data
			if (!isset($_POST['latitude'])||!isset($_POST['longitude'])) {
				echo json_encode(array('json_result'=>false));
				die();
			} else {
				$latitude 	= htmlspecialchars ( $_POST['latitude'] 	); 
				$longitude 	= htmlspecialchars ( $_POST['longitude'] 	); 
			}
			
			//Definitions
			$has_kiosk = false;
			
			//Get saved data 
			$saved_kiosks =  get_field('kiosk_repeater', 'option');
			
			//Look for kiosk 
			if ( !empty( $saved_kiosks ) ) { 
				foreach ( $saved_kiosks as $saved_kiosk ) {
					if ($saved_kiosk['kiosk_ip']==self::$kiosk_ip) {
						$has_kiosk = true; 
						break;
					} 
				}
			}
			
			//Not set, save  new
			if ( $has_kiosk == false ) {
				
				if ( !is_array( $saved_kiosks ) ) {
					$saved_kiosks = array();
				}
							
				//Add missing kiosk
				$saved_kiosks[] = array('kiosk_ip' => self::$kiosk_ip, 'kiosk_lat' => $latitude, 'kiosk_long' => $longitude ); 
				
				//Update all
				foreach ( $saved_kiosks as $kiosk_location_id => $kiosk_location ) {
					foreach ( $kiosk_location as $key => $value ) {
						update_sub_field( array('kiosk_repeater', ($kiosk_location_id+1), $key), $value );
					} 
				}
				
				//Update count
				update_option('options_kiosk_repeater', count($saved_kiosks)); 
				
			}
			
			//Result 
			echo json_encode(array('json_result'=>true)); 
			die(); 
			
		}
		
		public static function get_kiosk_location () {
			
			$saved_kiosks =  get_field('kiosk_repeater', 'option'); 
			
			//Look for kiosk 
			
			if ( !empty( $saved_kiosks ) ) { 
				
				foreach ( $saved_kiosks as $saved_kiosk ) {
					
					if( $saved_kiosk['kiosk_ip'] == $_SERVER['REMOTE_ADDR'] ) {
						$saved_kiosk['json_result'] = true; 
						
						if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
							echo json_encode( $saved_kiosk ); 
							die(); 
						} else {
							return json_encode( $saved_kiosk ); 
						}
					}
					
				}
			
			}
			
			//No kiosk saved 
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				echo json_encode( array('json_result' => false ) ); 
				die(); 
			} else {
				return json_encode( array('json_result' => false ) ); 
			}
			
		}
		
		public static function register_options_page () {
			
			if( function_exists('acf_add_options_page') ) {
	
				acf_add_options_page(array(
					'page_title' 	=> 'Platser för kiosker',
					'menu_title'	=> 'Kiosker',
					'menu_slug' 	=> 'kiosk-places',
					'capability'	=> 'edit_posts',
					'redirect'		=> false
				));
				
				
				if( function_exists('acf_add_local_field_group') ):

				acf_add_local_field_group(array (
					'key' => 'group_5644619e12701',
					'title' => 'Kioskplatser',
					'fields' => array (
						array (
							'key' => 'field_564463db4e449',
							'label' => '',
							'name' => '',
							'type' => 'message',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => 100,
								'class' => '',
								'id' => '',
							),
							'message' => 'Här listas platserna för samtliga kiosker som finns i installationen. Varje kiosk uppdaterar automatiskt sin plats vid första besöket. Om en kiosk skulle hamna fel på kartan, kan du ändra den här. Tar du bort en kiosk, kommer den att dyka upp här igen när den används första gången. 
				
				Samtliga kiosker kräver att en position finns lagrad för att plotta ut en vägbeskrivning till målet.',
							'new_lines' => 'wpautop',
							'esc_html' => 1,
						),
						array (
							'key' => 'field_5644646632d1a',
							'label' => 'Kiosker',
							'name' => 'kiosk_repeater',
							'type' => 'repeater',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'min' => '',
							'max' => '',
							'layout' => 'table',
							'button_label' => 'Lägg till kiosk',
							'sub_fields' => array (
								array (
									'key' => 'field_564499deb00c3',
									'label' => 'Kiosknamn',
									'name' => 'kiosk_name',
									'type' => 'text',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array (
										'width' => 25,
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
									'key' => 'field_564461a9025b6',
									'label' => 'Kiosk IP',
									'name' => 'kiosk_ip',
									'type' => 'text',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array (
										'width' => 25,
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
									'key' => 'field_564462fff65ec',
									'label' => 'Kiosk Latitude',
									'name' => 'kiosk_lat',
									'type' => 'number',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array (
										'width' => 25,
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => '',
									'prepend' => '',
									'append' => '',
									'min' => '',
									'max' => '',
									'step' => '',
									'readonly' => 0,
									'disabled' => 0,
								),
								array (
									'key' => 'field_5644635c37050',
									'label' => 'Kiosk Longitude',
									'name' => 'kiosk_long',
									'type' => 'number',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array (
										'width' => 25,
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => '',
									'prepend' => '',
									'append' => '',
									'min' => '',
									'max' => '',
									'step' => '',
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
								'value' => 'kiosk-places',
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

			}
		
		}
		
		public static function distance_kiosk($target_lat, $target_long ) {

			//Convert to floats 
			$target_lat 	= floatval( str_replace(",", ".", $target_lat ) ); 
			$target_long 	= floatval( str_replace(",", ".", $target_long ) );  
			
			//Get val
			$kiosk_data = json_decode( self::get_kiosk_location() );  
			
			if ( $kiosk_data->json_result == true ) {
				
				//Origin adssignments 
				$origin_lat 	= floatval( str_replace(",", ".", $kiosk_data->kiosk_lat ) ); 
				$origin_long 	= floatval( str_replace(",", ".", $kiosk_data->kiosk_long ) ); 
			
				//Calc degrees 
				$degrees = rad2deg(acos((sin(deg2rad($origin_lat))*sin(deg2rad($target_lat))) + (cos(deg2rad($origin_lat))*cos(deg2rad($target_lat))*cos(deg2rad($target_long-$target_long)))));
				
				//Convert to KM
				return $degrees * 60 * 1.609344 * 1.7;
				
			} else {
				return false; 
			}
			
		}
		
		function __destruct() {
			
		}
		
 	}
 	
 	new HelsingborgKioskLocation(); 
 	