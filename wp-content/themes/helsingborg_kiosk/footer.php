
		<footer id="footer">
			
			<nav id="category-nav" class="js-flickity" data-flickity-options='{ "cellAlign": "center", "contain": true, "pageDots": false, "asNavFor": ".page-main-slider" }'>
				<?php for ($x = 0; $x <= 10; $x++) { ?>
					<div class="slide-item"><a href="#" data-name="Skor" style="background-image: url('http://www.helsingborg.se/wp-content/uploads/2015/10/host_compressed.jpg');"></a></div>
				<?php } ?>
			</nav>
			
			<!--<nav id="navigation-item">
				<a href="#goback">Bakåt</a>
				<a href="#enter">Enter</a>
				<a href="#goup">Upp</a>
				<a href="#godown">Ned</a>							
			</nav>-->

		</footer>
		
		<!--[if lt IE 10]>
			<script src="http://jamesallardice.github.io/Placeholders.js/assets/js/placeholders.min.js"></script>
		<![endif]-->
				
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		    <script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
		
		<?php wp_footer(); ?>

	</body>

</html>