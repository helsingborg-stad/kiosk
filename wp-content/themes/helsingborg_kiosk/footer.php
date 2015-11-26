		</section>

		<?php global $post; ?>

		<form> <!-- Form for action buttons -->
			<footer class="navbar animated fadeInUp">

				<button tabindex="-1" class="btn btn-plain btn-prev pull-left" <?php if ( is_single( $post ) ) { echo 'style="visibility: hidden;"'; } ?> data-joystick="previous">
					<?php
						echo ' <i class="ion-arrow-left-b"></i>';
						_e("Föregående", 'kiosk');
					?>
				</button>

				<button tabindex="-1" id="center-button-select" class="btn btn-badge-icon btn-home" style="display:none;">
					<span class="animated bounceIn"><!-- Animationwrapper -->
						<i class="ion-ok">OK</i>
					</span>
					<span class="animated fadeIn">Välj</span>
				</button>

				<button tabindex="-1" id="center-button-exit-event" class="btn btn-badge-icon btn-home" style="display:none;">
					<span class="animated bounceIn"><!-- Animationwrapper -->
						<i class="ion-close-round"></i>
					</span>
					<span class="animated fadeIn">Stäng</span>
				</button>


				<?php if (is_front_page() ) { ?>

					<button tabindex="-1" id="center-button" class="btn btn-badge-icon btn-home" formaction="<?php echo get_post_type_archive_link("hbgkioskselfie"); ?>">
						<span class="animated bounceIn"><!-- Animationwrapper -->
							<i class="ion-ios-camera"></i>
						</span>
						<span class="animated fadeIn">Ta en selfie</span>
					</button>

				<?php } else { ?>

					<?php if ( is_single( $post ) ) { ?>

						<button tabindex="-1" id="center-button" class="btn btn-badge-icon btn-home one-step-back" formaction="<?php echo home_url(); ?>">
							<span class="animated bounceIn"><!-- Animationwrapper -->
								<i class="ion-android-list"></i>
							</span>
							<span class="animated fadeIn">Tillbaka till kategori</span>
						</button>

					<?php } else { ?>

						<button tabindex="-1" id="center-button" class="btn btn-badge-icon btn-home" formaction="<?php echo home_url(); ?>">
							<span class="animated bounceIn"><!-- Animationwrapper -->
								<i class="ion-ios-home"></i>
							</span>
							<span class="animated fadeIn">Tillbaka till startsidan</span>
						</button>

					<?php } ?>

				<?php } ?>

				<button tabindex="-1" class="btn btn-plain btn-next pull-right" <?php if ( is_single( $post ) ) { echo 'style="visibility: hidden;"'; } ?> data-joystick="next">
					<?php
						_e("Nästa", 'kiosk');
						echo ' <i class="ion-arrow-right-b"></i>';
					?>
				</button>

			</footer>
		</form>

		<!--[if lt IE 10]>
			<script src="http://jamesallardice.github.io/Placeholders.js/assets/js/placeholders.min.js"></script>
		<![endif]-->

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		    <script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->

		<?php wp_footer(); ?>
		
		<script>
			jQuery(function(){
				setTimeout(function(){
					jQuery("body").removeClass("doing-preload"); 
				}, 300); 
			});
		</script>

	</body>
</html>