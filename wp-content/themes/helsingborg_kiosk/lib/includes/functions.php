<?php 
	
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

    function dateToDay($date) {
        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime('tomorrow'));

        switch ($date) {
            case $today:
                return 'Idag';
                break;

            case $tomorrow:
                return 'Imorgon';
                break;

            default:
                return $date;
                break;
        }
    }