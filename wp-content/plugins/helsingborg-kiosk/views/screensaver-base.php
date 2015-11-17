<div class="screensaver-container">
    <div class="screensaver-slides">
        <?php
        foreach ($screensaverMedia as $media) {
            //var_dump($media);
            switch ($media->acf_fc_layout) {
                case 'screensaver-gallery':
                    require \HbgKiosk\Helper\Wp::getTemplate('screensaver-gallery');
                    break;

                case 'screensaver-gallery':
                    require \HbgKiosk\Helper\Wp::getTemplate('screensaver-instagram-feed');
                    break;

                case 'screensaver-poster':
                    require \HbgKiosk\Helper\Wp::getTemplate('screensaver-poster');
                    break;
            }
        }
        ?>
    </div>

    <div class="screensaver-cta">
        <span class="screensaver-cta-dot"></span>
        <span class="screensaver-cta-message">
            <h3>Hallå där!</h3>
            Hitta saker att göra i Helsingborg Stad
        </span>
    </div>
</div>