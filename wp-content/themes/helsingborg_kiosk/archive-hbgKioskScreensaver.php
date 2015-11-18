<?php
	$tabindex = 0; 
    get_header();
    $json = json_decode(file_get_contents('http://www.helsingborg.se/wp-content/plugins/helsingborg-widgets/helsingborg-event/json.php?count=6'));
?>

<div class="row event-list">
<?php
    foreach ($json as $item) :
        $tabindex++;
?>
    <a href="#" tabindex="<?php echo $tabindex; ?>" class="event-item">
        <?php if (isset($item->ImagePath) && $item->ImagePath != '') : ?>
            <div class="event-image" style="background-image:url('<?php echo $item->ImagePath; ?>');"></div>
        <?php endif; ?>

        <div class="index-container">
            <div class="index-date"><?php echo dateToDay($item->Date); ?> kl. <?php echo $item->Time; ?></div>
            <div class="index-date"><?php echo $item->Location; ?></div>
            <div class="index-caption"><?php echo $item->Name; ?></div>
            <div class="index-description"><?php echo wpautop($item->Description, true); ?></div>
        </div>
    </a>
<?php endforeach; ?>
</div>

<div class="event-backdrop"></div>


<?php get_footer(); ?>