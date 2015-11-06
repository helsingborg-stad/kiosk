<div class="screensaver-slide">
    <ul class="screensaver-gallery">
        <?php foreach ($media->{'screensaver-gallery-images'} as $item) : ?>
            <li class="screensaver-item">
                <div class="screensaver-item-frame">
                    <img src="<?php echo $item->url; ?>" alt="<?php echo $item->title; ?>">
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>