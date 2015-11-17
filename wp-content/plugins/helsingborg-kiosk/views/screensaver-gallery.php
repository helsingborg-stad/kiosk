<div class="screensaver-slide padding-1x" data-timeout="<?php echo $media->{'screensaver-slide-timeout'}; ?>" data-cta="<?php echo $media->{'screensaver-hide-cta'}; ?>">
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