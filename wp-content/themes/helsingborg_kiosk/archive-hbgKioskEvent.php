<?php
    get_header();
    $json = json_decode(file_get_contents('http://www.helsingborg.se/wp-content/plugins/helsingborg-widgets/helsingborg-event/json.php?count=6'));

    function dateToDay($date) {
        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime('tomorrow'));

        switch ($date) {
            case $today:
                return 'Idag';
                break;

            case $tomorrow:
                return 'Imorgon';
                break;

            default:
                return $data;
                break;
        }
    }
?>

<div class="row">
<?php
    foreach ($json as $item) :
        $tabindex++;
?>
    <div class="col-sm-4">
        <a href="#" tabindex="<?php echo $tabindex; ?>" class="event-item">
            <?php if (isset($item->ImagePath) && $item->ImagePath != '') : ?>
                <div class="event-image" style="background-image:url('<?php echo $item->ImagePath; ?>');"></div>
            <?php endif; ?>

            <div class="index-container">
                <div class="index-date"><?php echo dateToDay($item->Date); ?> kl. <?php echo $item->Time; ?></div>
                <div class="index-caption"><?php echo $item->Name; ?></div>
                <div class="index-description"><?php echo wpautop($item->Description, true); ?></div>
            </div>
        </a>
    </div>
<?php endforeach; ?>
</div>


<?php get_footer(); ?>