
		<footer id="footer">
			<?php $items = array("Äta","Shoppa","Resa","Fika","Hänga med börn"); ?>
			<nav id="category-nav" class="js-flickity" data-flickity-options='{ "cellAlign": "center", "contain": true, "pageDots": false, "asNavFor": ".page-main-slider", "wrapAround": true }'>

				<?php for ($x = 0; $x <= 10; $x++) { ?>
					<div class="slide-item"><a href="#" data-name="<?php echo $items[array_rand($items)]; ?>" style="background-image: url('http://www.helsingborg.se/wp-content/uploads/2015/10/host_compressed.jpg');"></a></div>
				<?php } ?>
			</nav>

			<!--<nav id="navigation-item">
				<a href="#goback">Bakåt</a>
				<a href="#enter">Enter</a>
				<a href="#goup">Upp</a>
				<a href="#godown">Ned</a>
			</nav>-->

		</footer>

		<!-- Modal -->
		<div class="modal animated fadeInRight" id="event-modal">
			
		  <div class="modal-dialog">
			  
		    <div class="modal-content">
		     
		      <div class="modal-header">
		        <div id="map-canvas" class="map-canvas"></div>
		      </div>
		     
		      <div class="modal-body">
			      
			      <article>

					  <h3 class="heading">Lakritsfabriken</h3>
					  
					  <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nullam id dolor id nibh ultricies vehicula ut id elit. Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Curabitur blandit tempus porttitor. Maecenas faucibus mollis interdum. Vestibulum id ligula porta felis euismod semper.</p>
					  
					  <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Nullam quis risus eget urna mollis ornare vel eu leo. Aenean lacinia bibendum nulla sed consectetur. Donec id elit non mi porta gravida at eget metus. Etiam porta sem malesuada magna mollis euismod. Curabitur blandit tempus porttitor. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
					  
			      </article>
				  
		      </div>
		      
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ion-ios-close-empty"></i> Stäng</button>
		      </div>
		      
		    </div><!-- /.modal-content -->
		    
		  </div><!-- /.modal-dialog -->
		  
		</div><!-- /.modal -->
		
		
		
		

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