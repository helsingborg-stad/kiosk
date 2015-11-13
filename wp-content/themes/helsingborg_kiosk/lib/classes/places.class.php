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
			//

			if ( !empty( $saved_kiosks ) && !is_null($saved_kiosks)) {

				foreach ( $saved_kiosks as $saved_kiosk ) {

					if( $saved_kiosk['kiosk_ip'] == self::$kiosk_ip ) {
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
					'capability'	=> 'administrator',
					'redirect'		=> false,
					'icon_url'		=> 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE2LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9Ijg5Ni4yNzVweCIgaGVpZ2h0PSI4OTYuMjc1cHgiIHZpZXdCb3g9IjAgMCA4OTYuMjc1IDg5Ni4yNzUiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDg5Ni4yNzUgODk2LjI3NTsiDQoJIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPHBhdGggZD0iTTc0MS4zNzEsMEw1ODkuMjI1LDE4NC40MzVjLTQxLjc1OC0yMy43NzMtOTEuNjk3LTM1LjYxNy0xNDIuOTQ1LTM1LjYxN2MtNTEuNjA5LDAtMTAwLjA3LDEyLjAxOC0xNDIuMDI2LDM2LjE2NQ0KCQlMMTU1LjM0MSwwbC0wLjEwNCw0NjMuMjgxYy0wLjc0OCwxMi4xMDUsMCwyNC40MzYsMCwzNy4yNzFjMCwxNzcuMjUyLDcyLjMyMSwzMjkuMzczLDE3NS43OTEsMzk0Ljg1Mg0KCQljLTU4LjI3MS03NS4xMzEtMTA4LjcyMi0xNTYuNjc4LTg1LjM0OC0yMzUuODc3YzEzMy45MzEtNS4zOTMsMTQ4LjA4Ny02LjEwNCwxNDguMDg3LTYuMTA0bDQ3LjMwNSwzOC41NTdsNTguMTc4LTM4LjU1Nw0KCQljOTcuNDA4LDAuNjk1LDE0My4zODMsMi43MTMsMTQzLjM4MywyLjcxM2M2LjAzNSw0OS42MzUtMi41OTIsMTU4LjQ4Ni04NS44NjksMjQwLjEzOQ0KCQlDNjYwLjkyLDgzMS4yMzIsNzM0LjY3Niw2NzguNTcsNzM0LjY3Niw1MDAuNTdjMC0xMi40NjktMC41NDctMjQuNTItMC41NDctMzYuMjk1TDc0MS4zNzEsMHogTTM4MC43MDYsNTIyLjQzMg0KCQljLTEzLjk4Miw1LjYtNDUuMjk2LDI0LjA1MS01OS44NDQsMjguNTIxYy0xNC41NDgsNC40ODYtMzQuNjcsNy4yNy00Mi41MDQsMGMtNy44MzQtNy4yNzEtMzMuMDA5LTMxLjMyMi0zOC4wMzUtMzYuOTA0DQoJCWMtNS4wMzUtNS42MTctOC4zOTItNTAuMzY1LDIxLjI1Mi00OC4xMDVjMzAuMTkxLDIuMjc5LDExMS44NjEsMzUuNzkxLDExNi44OTYsMzcuNDYxDQoJCUMzODMuNTA1LDUwNS4wOTIsMzk0LjY4OSw1MTYuODMsMzgwLjcwNiw1MjIuNDMyeiBNNjQ3Ljk3MSw1MTQuMDQ5Yy01LjAyNSw1LjU4Mi0zMC4yMDcsMjkuNjM1LTM4LjAyNSwzNi45MDQNCgkJYy03Ljg1NCw3LjI3LTI3Ljk1Nyw0LjQ4Ni00Mi41MDQsMGMtMTQuNTM5LTQuNDcxLTQ1Ljg2MS0yMi45MjQtNTkuODQ0LTI4LjUyMWMtMTQtNS42MDItMi44MDEtMTcuMzQsMi4yMjctMTkuMDI3DQoJCWM1LjAzNS0xLjY3LDg2LjcwMy0zNS4xODIsMTE2LjkwNC0zNy40NjFDNjU2LjM3OSw0NjMuNjg0LDY1My4wMjMsNTA4LjQzMiw2NDcuOTcxLDUxNC4wNDl6Ii8+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg=='
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
