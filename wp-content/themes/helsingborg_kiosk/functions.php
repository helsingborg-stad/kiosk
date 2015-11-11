<?php

	$root_dir = dirname(__FILE__)."/lib";
	$directorys = array (
		$root_dir.'/configurations/',
	    $root_dir.'/includes/',
	    $root_dir.'/classes/',
	    $root_dir.'/controllers/'
	);
    foreach ($directorys as $directory) {
        foreach(@glob($directory."*.php") as $filename) {
			require_once $filename;
		}
    }


    function has_subcategories($cat) {
        $categories = get_categories(array(
            'hide_empty' => false,
            'child_of'   => $cat
        ));

        if (count($categories) > 0) {
            return true;
        } else {
            return false;
        }
    }