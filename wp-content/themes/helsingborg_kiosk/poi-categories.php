<?php
$args = array(
    'type'       => 'hbgkioskpoi',
    'hide_empty' => false
);

if (isset($cat) && is_numeric($cat)) {
    $args['parent'] = $cat;
} else {
    $args['parent'] = 0;
}

$categories = get_categories($args);
?>

    <h1 id="content-headline">&nbsp;</h1>
    <div class="js-flickity----INACTIVE" data-flickity-options='{ "cellAlign": "left", "contain": true }'>
        <ul class="metro-grid">

            <?php
            if (count($categories) > 0) :
            foreach ($categories as $category) :
                $tabindex++;
                if ($category->name == 'Okategoriserade') continue;

                $background = get_field('poi-category-bg', $category);
                $icon = get_field('poi-category-icon', $category);

                if ( isset( $icon['url'] ) && !empty( $icon['url'] ) ) {
	                $iconSvg = file_get_contents($icon['url']);
                } else {
	                $iconSvg = "";
                }

                $href = get_category_link($category->term_id);
                if (strtolower(get_cat_name($category->term_id)) == 'evenemang') {
                    $href = '/event';
                }
            ?>
                <li class="metro-grid-item">
                    <a href="<?php echo $href; ?>" tabindex="<?php echo $tabindex; ?>">
                        <div class="metro-grid-item-image" <?php if (isset($background['url'])) : ?>style="background-image:url('<?php echo $background['url']; ?>');"<?php endif; ?>></div>
                        <div class="metro-grid-item-content">
                            <?php echo $iconSvg; ?>
                            <?php echo $category->name; ?>
                        </div>
                    </a>
                </li>
            <?php
            endforeach;
            else :
            ?>
            <li class="metro-grid-item">
                Inga kategorier att visa
            </li>
            <?php endif; ?>

        </ul>

    </div>