<?php
get_header();

the_post();

	// Update click stats
    $impressions = get_field('poi-impressions', $post->ID);
    $impressions++;
    update_field('poi-impressions', $impressions, $post->ID);

	//Get the image
	$imageUrl 		= get_post_meta($post->ID, 'poi-image', true);

	//Get avabile data (filter out all blank data)
	$sidebar_data = array_filter(
						array(
							'adress' 			=> get_post_meta($post->ID, 'poi-address', true),
							'postal_city' 		=> str_replace(" ", "", get_post_meta($post->ID, 'poi-postalcode', true) ) . " " . strtoupper( get_post_meta($post->ID, 'poi-city', true) ),
							'phone' 			=> formatPhoneNumber(get_post_meta($post->ID, 'poi-phone', true)),
							'url'				=> str_replace("http://", "", str_replace("www.", "", get_post_meta($post->ID, 'poi-website', true)))
						)
					);

	//Get position
	$latitude 		= get_post_meta($post->ID, 'poi-latitude', true);
	$longitude		= get_post_meta($post->ID, 'poi-longitude', true);

?>
	<aside>
		<div class="inner">
			<?php if (!filter_var($imageUrl, FILTER_VALIDATE_URL) === false) { ?> 
				<div class="image-max-height">
					<img src="<?php echo $imageUrl; ?>" style="width: 100%;" />
				</div>
			<?php } ?> 
			
			
			<?php
	
				if ( is_array( $sidebar_data ) && !empty( $sidebar_data ) ) {
	
					echo '<ul>';
	
						foreach ( $sidebar_data as $sidebar_id => $sidebar_item ) {
							
							if (!empty($sidebar_item) && $sidebar_item != "(0)" ) {
								
								echo '<li>'; 
								
									switch ($sidebar_id) {
									    case 'phone':
									    	echo '<i class="ion-ios-telephone" style="margin-right: 5px;"></i> ';
									        if ( strlen( $sidebar_item ) > 4 ) { echo '+46 ' . ltrim( $sidebar_item, '0' ); }
									        break;
									    case 'url': 
									 	   echo '<i class="ion-link" style="margin-right: 5px;"></i> ';
									 	   echo $sidebar_item;
									 	   break; 
									 	case 'adress': 
									 	   echo '<i class="ion-ios-navigate" style="margin-right: 5px;"></i> ';
									 	   echo $sidebar_item;
									 	   break; 
									 	case 'postal_city': 
									 	   echo '<span style="display: inline-block; width: 20px;"></span> ';
									 	   echo $sidebar_item;
									 	   echo '<span style="display: block; height: 10px;"></span> ';
									 	   break; 
									    default:
									       echo $sidebar_item;
									       break;  
									}
									
								echo '</li>';
								
							}
	
						}
	
					echo '</ul>';
	
				}
			?>
		</div>
	
		<div class="inner animated fadeIn">
			<?php get_template_part('contact-message'); ?> 
		</div>
		
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