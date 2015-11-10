<?php
get_header();
$categories = get_categories(array(
	'type' => 'hbgkioskpoi'
));
?>

    <h1 id="content-headline">Vad vill du göra idag?</h1>
    <div class="js-flickity----INACTIVE" data-flickity-options='{ "cellAlign": "left", "contain": true }'>
	    <ul class="metro-grid">

	    	<?php
	    	if (count($categories) > 0) :
	    	foreach ($categories as $category) :
	    		if ($category->name == 'Okategoriserade') continue;
	    		$background = get_field('poi-category-bg', $category);
	    		$icon = get_field('poi-category-icon', $category);
	    		$iconSvg = file_get_contents($icon['url']);
	    	?>
				<li class="metro-grid-item">
		            <a href="/category/<?php echo $category->slug; ?>">
		                <div class="metro-grid-item-image" style="background-image:url('<?php echo $background['url']; ?>');"></div>
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

<?php get_footer(); ?>