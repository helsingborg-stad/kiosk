<?php

	if ( !isset( $tabindex ) ) {
		$tabindex = 0;
	}

    // Update click stats
    $impressions = get_field('poi-category-impressions', 'category_' . $cat);
    $impressions++;
    update_field('poi-category-impressions', $impressions,'category_' . $cat);

    //Get places
    $HelsingborgKioskFrontend   = new HelsingborgKioskFrontend;
    $places                     = $HelsingborgKioskFrontend->get_places($cat);

    if ( is_array( $places ) && !empty( $places ) ) {

        if( count( $places ) > 1 ) {
            $class = "paged-content flickity-swipe";
        } else {
            $class = "not-paged";
        }

        echo '<div class= "' . $class . '" tabindex="-1">';

            foreach ( $places as $page_data ) {

                echo '<ul class="list-section-places page-with-places list-item">';

                    foreach ( $page_data as $list_item ) {

                        $tabindex++;

                        echo' <li>';
                        echo'   <a href="'.$list_item['post_link'].'" tabindex="' . $tabindex . '">';
                        echo'       <span class="image" style="background-image: url(\''.$list_item['post_image'].'\');"></span>';
                        echo'       <span class="title">'.$list_item['post_title'].'</span>';
                        echo'       <span class="action"><i class="fa fa-arrow-circle-o-right"></i></span>';
						echo'		<span class="distance"><i class="ion-android-walk"></i> '. ( ( $list_item['post_distance'] != "0.0" ) ? $list_item['post_distance'] . " KM" : __("I närheten") ) .'</span>';
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