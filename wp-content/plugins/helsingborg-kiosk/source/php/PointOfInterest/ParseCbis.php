<?php

namespace HbgKiosk\PointOfInterest;

use HbgKiosk\PointOfInterest\CustomPostType;

class ParseCbis
{
    public $path;
    public $csv;
    public $header;
    public $data;
    public $db; 

    public function __construct($path)
    {
        set_time_limit(600);

		//Get local wpdb object 
		global $wpdb; 
		$this->db = $wpdb; 

        $this->path = $path;
        $this->data = $this->getData($this->path);
        $this->save($this->data);
        echo '<br><span style="color:#5ec61a">PROCESSEN SLUTFÖRD!</span>';
        
        
        
    }

    /**
     * Parses the CSV-file into array
     * @param  string $path      The csv-file's path
     * @param  string $delimiter The delimiter to use (semicolon by default)
     * @return array             The csv data as an array
     */
    public function getData($path, $delimiter = ';')
    {
        $file = fopen($path, "r");
        $data = array();

        while (!feof($file)) {
            $data[] = fgetcsv($file, null, $delimiter);
        }

        fclose($file);

        // Save the header information
        $this->header = $this->getHeader($data, true);
        unset($data[0]);

        $modifiedKeys = array();

        // Set keys and utf8-encode
        foreach ($data as $rowKey => $rowData) {
            if (is_array($rowData)) {
                foreach ($rowData as $key => $value) {
                    $key = utf8_encode($this->header[$key]);
                    $key = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $key);
                    $key = lcfirst($key);
                    $modifiedKeys[$rowKey][$key] = $value;
                }
            }
        }

        $modifiedKeys = json_decode(json_encode($modifiedKeys));

        return $modifiedKeys;
    }

    /**
     * Gets the first row (presumably the header)
     * @param array   $data     The csv data
     * @return array The data in the first row
     */
    public function getHeader($data)
    {
        return $data[0];
    }

    public function save($data)
    {
		//Remove posts missing from this import
        $this->deleteMissingPoi($this->getMissingPoi($data)); 
        $this->remove_orphaned_meta(); 
        	
        foreach ($data as $item) {
            $this->addPost($item);
        }
        
    }
    
    public function getMissingPoi( $data,$imported_ids = array(),$saved_ids = array()) { 
	    
	    //Get list of imported ids 
	    if (count($data)) {
		    foreach ( $data as $item ) {
			    $imported_ids[] = $item->id; 
		    } 
		    $imported_ids = array_unique($imported_ids); 
	    } 
	    
	    //Get list of saved ids 
	    $saved_ids = $this->db->get_col("SELECT meta_value FROM ".$this->db->postmeta." WHERE meta_key = 'poi-id'"); 

	    //Return differance id 
	    if (is_array($imported_ids) && is_array($saved_ids) && !empty( $imported_ids ) && !empty( $saved_ids ) ) {
		    return array_diff($saved_ids,$imported_ids);
	    } else {
		    return false; 
	    }
	    
    }
    
    public function deleteMissingPoi($ids_to_delete, $deleted_ids = array()) {

	    if (is_array($ids_to_delete) && !empty($ids_to_delete)) {
		    foreach($ids_to_delete as $id ) {
			    
			    $post_id_to_delete = $this->db->get_col(
				    $this->db->prepare("SELECT post_id FROM ".$this->db->postmeta." WHERE meta_key = 'poi-id' AND meta_value = %d LIMIT 1", $id)
			    ); 

			    //Single id 
			    if ( is_array($post_id_to_delete) && count($post_id_to_delete) == 1 ) {
	
				    $post_id_to_delete = array_pop($post_id_to_delete); 

				    if (is_numeric($post_id_to_delete) && wp_delete_post($post_id_to_delete,true)) {
					   	
					    $deleted_ids[] = $post_id_to_delete; 
				  	}
				  	
				}
			    
		    }
		    echo "Deleted ".count($deleted_ids)." posts: ".implode(",", $deleted_ids)." <br/>"; 
	    }
	    
    }
    
    public function remove_orphaned_meta () {
	    $this->db->query("
			DELETE pm 
			FROM ".$this->db->postmeta." pm
			LEFT JOIN ".$this->db->posts." wp ON wp.ID = pm.post_id
			WHERE wp.ID IS NULL
		"); 
    }

    public function addPost(&$data)
    {
        // If this is an event, skip it
        if (strpos(strtolower($data->categories), 'evenemang') !== false) {
            return;
        }

        // Check if this poi already exist
        $poi = CustomPostType::get(1, array(
            array(
                'key' => 'poi-id',
                'value' => $data->id,
                'compare' => '='
            )
        ), true);

        $postId = (isset($poi[0]->ID)) ? $poi[0]->ID : null;

        // Check if required item values exist and is correct formatted, else set post as draft
        $post_status = 'publish';
        if (!$this->requiredValuesExist($data)) {
            $post_status = 'draft';
        }

        // If coordinates missing, try to get them from Google API
        if (!$this->coordinatesExist($data)) {
            $coordinates = $this->getCoordinatesByAddress($data->streetAddress1 . ' ' . $data->cityAddress);

            $post_status = 'draft';

            if ($coordinates) {
                $data->latitude = $coordinates->lat;
                $data->longitude = $coordinates->lng;
                $post_status = 'publish';
            }
        }

        // If address is missing and coordinates is given, try to get address from Google API
        if (!$this->addressExist($data)) {
            $address = $this->getAddressByCoordinates($data->latitude, $data->longitude);

            $post_status = 'draft';

            if ($address) {
                $data->streetAddress1 = $address->street;
                $data->cityAddress = $address->city;
                $data->postalCode = $address->postalcode;
                $post_status = 'publish';
            }
        }

        // Decide if we're updating an existing post or if creating a new one
        if ($postId !== null) {
            echo "<strong>Updating post:</strong> $post_status<br>";
            wp_update_post(array(
                'ID'           => $postId,
                'post_title'   => $data->name,
                'post_content' => $data->introduction . "\n\n" . $data->description,
                'post_status'  => $post_status,
                'post_type'    => 'hbgKioskPOI'
            ));
        } else {
            echo "<strong>Creating post:</strong> $post_status<br>";
            $postId = wp_insert_post(array(
                'post_title'   => $data->name,
                'post_content' => $data->introduction . "\n\n" . $data->description,
                'post_status'  => $post_status,
                'post_type'    => 'hbgKioskPOI'
            ));
        }

        // Set the posts metafields
        $this->setPostMeta($postId, $data);

        // Map categories
        $this->mapCategories($postId, $data);
        
    }

    /**
     * Maps the CBIS categories with the categories of the POI post type
     * @param  integer $postId The current post id (which the categories should be mapped for)
     * @param  object  $data   The cbis data
     * @return void
     */
    private function mapCategories($postId, $data)
    {
        $matches = array();
        $cbisCategories = array_map('trim', explode(',', $data->categories));
        $postCategories = get_categories(array('hide_empty' => false));

        foreach ($postCategories as $postCategory) {
            $mapTheseCategories = get_field('poi-category-map', 'category_' . $postCategory->term_id);

            if (is_array($mapTheseCategories)) {
                foreach ($mapTheseCategories as $map) {
                    if (in_array(html_entity_decode($map->name), $cbisCategories)) {
                        $matches[] = $postCategory->term_id;
                    }
                }
            }
        }

        wp_set_post_categories($postId, $matches, false);
    }

    /**
     * Set a POI post's meta fields
     * @param   integer $postId The post's id
     * @param   object  $data   The cbis data
     * @return  void
     */
    private function setPostMeta($postId, $data)
    {
        // Update post meta
        update_post_meta($postId, 'poi-id', $data->id);
        update_post_meta($postId, 'poi-city', $data->cityAddress);
        update_post_meta($postId, 'poi-address', $data->streetAddress1);
        update_post_meta($postId, 'poi-postalcode', $data->postalCode);
        update_post_meta($postId, 'poi-latitude', $data->latitude);
        update_post_meta($postId, 'poi-longitude', $data->longitude);
        update_post_meta($postId, 'poi-phone', $data->phoneNumber);
        update_post_meta($postId, 'poi-price', $data->price);
        update_post_meta($postId, 'poi-image', $data->imageUrl);

        // Update CBIS-categories taxonomy
        wp_set_post_terms($postId, $data->categories, 'cbisCategories', $append = false);
    }

    /**
     * Checks if required values exist in cbis item
     * @param  object $data The cbis data
     * @return boolean
     */
    private function requiredValuesExist($data)
    {
        if ((!is_numeric($data->id)) // ID is numeric
            || (empty($data->longitude)) // longitude is float
            || (empty($data->latitude)) // latitude is float
            || (empty($data->streetAddress1)) // street address is empty
            || (empty($data->cityAddress)) // city address is empty
            || (!is_numeric($data->templateId)) // template id is numeric
            || (!is_numeric($data->supplierId)) // supplier id is numeric
        ) {
            return false;
        }

        return true;
    }

    /**
     * Checks if cbis item includes valid coordinates
     * @param  object $data The cbis data
     * @return boolean
     */
    private function coordinatesExist($data)
    {
        if (!empty($data->streetAddress1)
            && !empty($data->cityAddress)
            && (empty($data->longitude)
            || empty($data->latitude))
        ) {
            return false;
        }

        return true;
    }

    /**
     * Checks if cbis item includes address
     * @param  object $data The cbis data
     * @return boolean
     */
    private function addressExist($data)
    {
        if (!empty($data->longitude) && !empty($data->latitude)
            && (empty($data->streetAddress1) || empty($data->cityAddress))
        ) {
            return false;
        }

        return true;
    }

    /**
     * Get coordinates from address
     * @param  string $address Address
     * @return array          Lat and long
     */
    public function getCoordinatesByAddress($address)
    {
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address);
        $data = json_decode(file_get_contents($url));

        if ($data->status == 'OK') {
            return $data->results[0]->geometry->location;
        } else {
            return false;
        }
    }

    /**
     * Get coordinates from address
     * @param  string $address Address
     * @return array          Lat and long
     */
    public function getAddressByCoordinates($lat, $lng)
    {
        $lat = str_replace(',', '.', $lat);
        $lng = str_replace(',', '.', $lng);
        $coordinates = $lat . ',' . $lng;

        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . urlencode($coordinates);
        $data = json_decode(file_get_contents($url));

        if ($data->status == 'OK') {
            return (object)array(
                'street' => $data->results[0]->address_components[1]->long_name . ' ' . $data->results[0]->address_components[0]->long_name,
                'city' => (isset($data->results[0]->address_components[3]->long_name)) ? $data->results[0]->address_components[3]->long_name : null,
                'postalcode' => (isset($data->results[0]->address_components[6]->long_name)) ? $data->results[0]->address_components[6]->long_name : null
            );
        } else {
            return false;
        }
    }
}
