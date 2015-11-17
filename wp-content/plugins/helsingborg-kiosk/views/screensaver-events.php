<?php
$json = json_decode(file_get_contents('http://www.helsingborg.se/wp-content/plugins/helsingborg-widgets/helsingborg-event/json.php?count=' . $media->{'screensaver-events-show'}));

?>
<div class="screensaver-slide padding-1x" data-timeout="<?php echo $media->{'screensaver-events-timeout'}; ?>" data-cta="<?php echo $media->{'screensaver-hide-cta'}; ?>">
    <?php if (isset($media->{'screensaver-events-title'}) && strlen($media->{'screensaver-events-title'}) > 0) : ?>
        <h1><?php echo $media->{'screensaver-events-title'}; ?></h1>
    <?php endif; ?>

    <ul class="screensaver-events">
        <?php foreach ($json as $item) : ?>
            <li>
                <span class="event-date"><?php echo dateToDay($item->Date); ?> kl. <?php echo $item->Time; ?></span>
                <span class="event-name"><?php echo $item->Name; ?></span>
                <span class="event-location"><?php echo $item->Location; ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>