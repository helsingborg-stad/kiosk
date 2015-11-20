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

$tabindex = 0; 

?>

    <h1 id="content-headline">
		<?php 
			if( is_front_page() && function_exists( 'get_field' ) ) {
				echo get_field('front_page_title', 'option');		
			} else {
				echo "&nbsp";
			}
		?>
	</h1>

    <ul class="metro-grid">
	    
	    <?php 
		    
		    if ( function_exists( 'get_field' ) ) { 
		    
			    if ( count( $categories ) ) {
				    
				    foreach ($categories as $category) {
				     
				     	//Skip hidden 
				     	$is_hidden = get_field('poi-category-inactive', $category); 
			            if ( $is_hidden ) continue;
			
						//Counter for tabindex 
						$tabindex++;
						
						//Get data 
			            $background 	= get_field('poi-category-bg', 		$category);
			            $icon 			= get_field('poi-category-icon', 	$category);
			
						//Filter icon
			            if ( isset( $icon['url'] ) && !empty( $icon['url'] ) ) {
			                $iconSvg = file_get_contents($icon['url']);
			            } else {
			                $iconSvg = "";
			            }
			
						//Get url for event page 
			            $href 	= get_category_link($category->term_id);
			            if (strtolower(get_cat_name($category->term_id)) == 'evenemang') {
			                $href = get_post_type_archive_link('hbgkioskevent');
			            }
			            
			             ?>
				            <li class="metro-grid-item">
				                <a href="<?php echo $href; ?>" tabindex="<?php echo $tabindex; ?>">
				                    <div class="metro-grid-item-image" <?php if (isset($background['sizes']['puff-image'])) : ?>style="background-image:url('<?php echo $background['sizes']['puff-image']; ?>');"<?php endif; ?>></div>
				                    <div class="metro-grid-item-content">
				                        <?php echo $iconSvg; ?>
				                        <?php echo $category->name; ?>
				                    </div>
				                </a>
				            </li>
				        <?php
					        
					}

			    } else {
		       		echo '<li class="metro-grid-item">Inga kategorier att visa</li>'; 
		        }

		    } else {
			    echo "ACF missing."; 
		    }
	    
		?>
		
    </ul>