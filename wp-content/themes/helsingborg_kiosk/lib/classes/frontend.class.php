<?php

	Class HelsingborgKioskFrontend {

		public function __construct() {

		}

		public function get_places($category, $items_per_page = 5, $limit = -1) {

			//Declare
			$items = array();

			$posts = get_posts(array(
				'post_type' 		=> 'hbgkioskpoi',
				'posts_per_page' 	=> -1,
				'category' 			=> $category,
				'orderby' 			=> 'post_title',
				'order' 			=> 'ASC'
			));

			foreach ($posts as $post) {
				
				//Get distance 
				$full_distance = 	HelsingborgKiosk\Locations\HelsingborgKioskLocation::distance_kiosk(
										get_post_meta($post->ID, 'poi-latitude', true),
										get_post_meta($post->ID, 'poi-longitude', true)
									); 
									
				//Filter out further than 10 km
				if ( $full_distance >= 10 ) {
					unset( $items[$post->ID ] ); 
				} else {

					//Get more data if valid 
					$items[$post->ID] = array(
						'post_image'	=> get_post_meta($post->ID, 'poi-image', true),
						'post_title' 	=> $post->post_title,
						'post_link'		=> get_permalink($post->ID),
						'post_distance'	=> number_format( $full_distance , 1 ),
						'full_distance'	=> $full_distance
					);
					
				}
			
			}
			
			//Sort array 
			usort($items, function ($a, $b) {
				return ( $a["full_distance"] < $b["full_distance"] ) ? -1 : 1;
			}); 

			//Return chunked
			return array_chunk($items, $items_per_page);

		}

		public function __destruct() {

		}

	}