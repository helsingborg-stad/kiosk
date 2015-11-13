<?php
	
	

namespace HbgKiosk\PointOfInterest;

use HbgKiosk\PointOfInterest\CustomPostType;

class ParseCbis
{
    public $path;
    public $csv;
    public $header;
    public $data;

    public function __construct($path)
    {
	    
	    set_time_limit ( 600 ); 
	    
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
                    $key = lcfirst($this->header[$key]);
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
        foreach ($data as $item) {
            $this->addPost($item);
        }
    }

    public function addPost($data)
    {
        // Check if this poi already exist
        $poi = CustomPostType::get(1, array(
            array(
                'key' => 'poi-id',
                'value' => $data->id,
                'compare' => '='
            )
        ),true);
+
        $postId = (isset($poi[0]->ID)) ? $poi[0]->ID : null;

        // Check if required item values exist and is correct formatted, else set post as draft
        $post_status = 'publish';
        if (
               (!is_numeric($data->id)) // ID is numeric
            || (empty($data->longitude)) // longitude is float
			|| (empty($data->latitude)) // latitude is float
            || (!is_numeric($data->templateId)) // template id is numeric
            || (!is_numeric($data->supplierId)) // supplier id is numeric
        ) {
            $post_status = 'draft';
        }

        // Decide if we're updating an existing post or if creating a new one
        if ($postId !== null) {
            echo "<strong>Updating post</strong><br>";
            wp_update_post(array(
                'ID'           => $postId,
                'post_title'   => $data->name,
                'post_content' => $data->introduction . "\n\n" . $data->description,
                'post_status'  => $post_status,
                'post_type'    => 'hbgKioskPOI'
            ));
        } else {
            echo "<strong>Creating post</strong><br>";
            $postId = wp_insert_post(array(
                'post_title'   => $data->name,
                'post_content' => $data->introduction . "\n\n" . $data->description,
                'post_status'  => $post_status,
                'post_type'    => 'hbgKioskPOI'
            ));
        }

        // Update post meta
        update_post_meta($postId, 'poi-id', $data->id);
        update_post_meta($postId, 'poi-city', $data->cityAddress);
        update_post_meta($postId, 'poi-address', $data->streetAddress1);
        update_post_meta($postId, 'poi-postalcode', $data->postalCode);
        update_post_meta($postId, 'poi-latitude', $data->latitude);
        update_post_meta($postId, 'poi-longitude', $data->longitude);
        update_post_meta($postId, 'poi-phone', $data->phoneNumber);
        update_post_meta($postId, 'poi-price', $data->price);
        update_post_meta($postId, 'poi-image', $data->image);

        // Update CBIS-categories taxonomy
        wp_set_post_terms($postId, $data->categories, 'cbisCategories', $append = false);

        // Map categories

        $cbisCategories = array_map('trim', explode(',', $data->categories));
        $postCategories = get_categories(array('hide_empty' => false));

        foreach ($postCategories as $postCategory) {
            $mapTheseCategories = get_field('poi-category-map', 'category_' . $postCategory->term_id);

            if (is_array($mapTheseCategories)) {
                foreach ($mapTheseCategories as $map) {

                    if (in_array(html_entity_decode($map->name), $cbisCategories)) {
                        wp_set_post_categories($postId, array($postCategory->term_id), false);
                    }

                }
            }
        }
    }
}
