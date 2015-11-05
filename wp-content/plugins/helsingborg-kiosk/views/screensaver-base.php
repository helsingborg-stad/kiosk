<div class="screensaver-container">
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
        }
    }
    ?>

    <div class="screensaver-cta">
        <span class="screensaver-cta-dot"></span>
        <span class="screensaver-cta-message">
            <h3>Hallå där!</h3>
            Hitta saker att göra i Helsingborg Stad
        </span>
    </div>
</div>