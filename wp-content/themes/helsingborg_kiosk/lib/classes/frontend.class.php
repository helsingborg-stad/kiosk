<?php
	
	Class HelsingborgKioskFrontend {
		
		public function __construct() {
			
		}
		
		public function get_places ($category, $items_per_page = 5, $limit = -1) {
			
			//Declare 
			$items = array(); 
			
			
			//Fake items for now 
			$fake_item = 	array(
								'post_image'	=> 'http://www.helsingborg.se/wp-content/uploads/2014/12/Arbete_2_420x280_Foto_Anna_Olsson.jpg',
								'post_title' 	=> 'Integer posuere erat a ante venenatis dapibus posuere velit aliquet.',
								'post_link'		=> 'http://helsingborg.kiosk/poi/sollicitudin-mollis/',
								'post_distance'	=> 15,
							); 
			
			
			for ($x = 0; $x <= 50; $x++) {
				$items[] =	$fake_item; 
			}
			
			//Return chunked 
			return array_chunk($items, $items_per_page ); 
			
		}
		
		public function __destruct() {
			
		}
		
	}