<div class="screensaver-container">
    <div class="screensaver-slides">
        <?php

	        if (count( $screensaverMedia ) ) {

		        foreach ($screensaverMedia as $media) {
		            //var_dump($media);
		            switch ($media->acf_fc_layout) {
		                case 'screensaver-gallery':
		                    require \HbgKiosk\Helper\Wp::getTemplate('screensaver-gallery');
		                    break;

		                case 'screensaver-instagram':
		                    require \HbgKiosk\Helper\Wp::getTemplate('screensaver-instagram-feed');
		                    break;

		                case 'screensaver-twitter':
		                    require \HbgKiosk\Helper\Wp::getTemplate('screensaver-twitter-feed');
		                    break;

		                case 'screensaver-poster':
		                    require \HbgKiosk\Helper\Wp::getTemplate('screensaver-poster');
		                    break;

		                case 'screensaver-events':
		                    require \HbgKiosk\Helper\Wp::getTemplate('screensaver-events');
		                    break;
		            }
		        }

		    }

        ?>
    </div>

    <div class="screensaver-cta">
        <span class="screensaver-cta-dot"></span>
        <span class="screensaver-cta-message">
            <h3><?php echo get_option('options_screensaver-lead-title'); ?></h3>
            <?php echo get_option('options_screensaver-lead-caption'); ?>
        </span>
    </div>
</div>