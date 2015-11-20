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

?>

<div class="slider flickity-swipe">
    <?php foreach ($places as $page) : ?>
    <ul class="slider-page list-item">
        <?php foreach ($page as $item) : $tabindex++; ?>
        <li>
            <a class="slider-row" href="<?php echo $item['post_link']; ?>" tabindex="<?php echo $tabindex; ?>">
                <span class="place-image"><span style="background-image: url('<?php echo $item['post_image']; ?>');"></span></span>
                <span class="place-title"><?php echo $item['post_title']; ?></span>
                <span class="place-distance"><i class="ion-android-walk"></i> <?php echo ( ( $item['post_distance'] != "0.0" ) ? $item['post_distance'] . " KM" : __("I närheten") ); ?></span>
                <span class="place-action"><i class="fa fa-arrow-circle-o-right"></i></span>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endforeach; ?>
</div>