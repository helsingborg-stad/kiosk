<?php
get_header();

the_post();

	//Get the image
	$imageUrl 		= get_post_meta($post->ID, 'poi-image', true);

	//Get avabile data (filter out all blank data)
	$sidebar_data = array_filter(
						array(
							'adress' 	=> get_post_meta($post->ID, 'poi-address', true),
							'postal' 	=> get_post_meta($post->ID, 'poi-postalcode', true),
							'city' 		=> get_post_meta($post->ID, 'poi-city', true),
							'phone' 	=> get_post_meta($post->ID, 'poi-phone', true)
						)
					);

	//Get position
	$latitude 		= get_post_meta($post->ID, 'poi-latitude', true);
	$longitude		= get_post_meta($post->ID, 'poi-longitude', true);

?>
	<aside>

		<img src="<?php echo $imageUrl; ?>" style="width: 100%;" />

		<?php

			if ( is_array( $sidebar_data ) && !empty( $sidebar_data ) ) {

				echo '<ul>';

					foreach ( $sidebar_data as $sidebar_id => $sidebar_item ) {

						switch ($sidebar_id) {
						    case 'phone':
						        if ( strlen( $sidebar_item ) > 4 ) { echo '+46 (0)' . ltrim( $sidebar_item, '0' ); }
						        break;
						    default:
						       echo '<li>'.$sidebar_item.'</li>';
						}

					}

				echo '</ul>';

			}
		?>

	</aside>

	<article>

		<div class="scroll-wrapper">
			<main>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</main>
		</div>

		<nav class="nav-scroll">
			<button class="btn btn-plain btn-prev pull-left" data-action="scroll-up" data-selector=".scroll-wrapper"><i class="ion-chevron-up"></i> Upp</button>
			<button class="btn btn-plain btn-prev pull-right" data-action="scroll-down" data-selector=".scroll-wrapper"><i class="ion-chevron-down"></i> Ner</button>
		</nav>

	</article>

<?php get_footer(); ?>