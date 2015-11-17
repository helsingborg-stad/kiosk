<?php
$items = false;
if (function_exists('get_instagram_hashtag')) {
    $items = get_instagram_hashtag($media->{'screensaver-instagram-hashtag'}, 8);
}

if ($items) :
?>

<div class="screensaver-slide padding-1x" data-timeout="<?php echo $media->{'screensaver-slide-timeout'}; ?>" data-cta="<?php echo $media->{'screensaver-hide-cta'}; ?>">
    <ul class="screensaver-gallery">
        <?php foreach ($items as $item) : ?>
            <li class="screensaver-item">
                <div class="screensaver-item-frame">
                    <img src="<?php echo $item->image; ?>">
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php endif; ?>