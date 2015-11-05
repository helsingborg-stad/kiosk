<?php get_header(); ?>
	
	<?php $items = array("Sollicitudin Ornare Mattis Fusce", "Purus Tortor","Nibh Pellentesque Tellus Vestibulum Risus", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ullamcorper nulla non metus auctor fringilla."); ?>
	<section id="content">
	
		<div class="js-flickity page-main-slider"  data-flickity-options='{ "cellAlign": "left", "contain": true, "pageDots": false, "prevNextButtons": false}'>
			<?php for ($a = 0; $a <= 10; $a++) { ?>
				<div class="slide-panel animated bounceInUp">
			
					<h2><span>Shopping</span><span>Kläder</span></h2>
			
					<div class="list-group">
						<span class="overflower">
							<?php for ($x = 0; $x <= 50; $x++) { ?>
								<a class="list-group-item show-event-modal">
									<span class="title"><?php echo $items[array_rand($items)]; ?> </span>
									<span class="badge"><?php echo rand($x+1,$x+4); ?>KM</span>
								</a>
							<?php } ?>
						</span>
					</div>
			
				</div>
			<?php } ?>
		</div>
		
	</section>

<?php get_footer(); ?>