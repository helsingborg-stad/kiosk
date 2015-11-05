<div class="screensaver-container">
    <?php
    foreach ($screensaverMedia as $media) {
        switch ($media->acf_fc_layout) {
            case 'screensaver-gallery':
                require \HbgKiosk\Helper\Wp::getTemplate('screensaver-gallery');
                break;

            case 'screensaver-gallery':
                require \HbgKiosk\Helper\Wp::getTemplate('screensaver-instagram-feed');
                break;
        }
    }
    ?>
</div>