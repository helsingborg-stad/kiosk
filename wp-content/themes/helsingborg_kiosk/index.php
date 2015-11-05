<?php get_header(); ?>
	
	<section id="content">
	
		<div class="js-flickity page-main-slider"  data-flickity-options='{ "cellAlign": "left", "contain": true, "pageDots": false, "prevNextButtons": false}'>
			<?php for ($a = 0; $a <= 10; $a++) { ?>
				<div class="slide-panel">
			
					<h2>Sem Porta Lorem</h2>
			
					<ul class="list-group">
						<span class="overflower">
							<?php for ($x = 0; $x <= 10; $x++) { ?>
								<li class="list-group-item">
								    <span class="badge">14</span>
								    Cras justo odio
								</li>
							<?php } ?>
						</span>
					</ul>
			
				</div>
			<?php } ?>
		</div>
		
	</section>

<?php get_footer(); ?>