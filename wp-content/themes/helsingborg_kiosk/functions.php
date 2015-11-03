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