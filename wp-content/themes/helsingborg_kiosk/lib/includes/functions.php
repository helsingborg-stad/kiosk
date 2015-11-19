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

    function formatPhoneNumber($num) {
        if (is_null($num)) return;

        // Check if first char is a zero
        if (substr($num, 0, 3) !== '(0)') {
            $num = '(0)' . $num;
        }

        return $num;
    }