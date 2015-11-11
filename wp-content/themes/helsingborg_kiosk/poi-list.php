<?php

    //Get places
    $HelsingborgKioskFrontend   = new HelsingborgKioskFrontend;
    $places                     = $HelsingborgKioskFrontend->get_places($cat);

    if ( is_array( $places ) && !empty( $places ) ) {

        if( count( $places ) > 1 ) {
            $class = "paged-content js-flickity";
        } else {
            $class = "not-paged";
        }

        echo '<div class= "' . $class . '" data-flickity-options=\'{ "cellAlign": "left", "contain": true, "wrapAround": true, "prevNextButtons": false, "cellSelector": ".list-item" }\'>';

            echo '<div id="helperGesture" class="hand-gestrure-swipe">';
                echo '<i class="fa fa-hand-pointer-o animated fadeOutLeft"></i>';
            echo '</div>';

            foreach ( $places as $page_data ) {
                $tabindex++;

                echo '<ul class="list-section-places page-with-places list-item">';

                    foreach ( $page_data as $list_item ) {

                        echo' <li>';
                        echo'   <a href="'.$list_item['post_link'].'" tabindex="' . $tabindex . '">';
                        echo'       <span class="image" style="background-image: url(\''.$list_item['post_image'].'\');"></span>';
                        echo'       <span class="title">'.$list_item['post_title'].'</span>';
                        echo'       <span class="action"><i class="fa fa-arrow-circle-o-right"></i></span>';
                        echo'       <span class="distance"><i class="ion-android-walk"></i> '.$list_item['post_distance'].' KM</span>';
                        echo'   </a>';
                        echo' </li>';

                    }

                echo '</ul>';

            }

        echo '</div>';

    } else {
        get_template_part('custom','404');
    }

?>