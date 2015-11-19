<?php
get_header();

$content = array(
    'lead' => get_option('options_selfie_page_subtitle'),
    'instructions' => get_field('selfie_instructions', 'options')
);

$content = array_filter($content);

?>
<div class="selfie">
    <?php if (isset($content['lead'])) : ?><div class="lead"><?php echo $content['lead']; ?></div><?php endif; ?>
    <?php if (isset($content['instructions'])) : ?>
    <ol class="numbered-list">
        <?php foreach ($content['instructions'] as $item) : ?>
        <li>
            <span class="title"><?php echo $item['instr_title']; ?></span>
            <p><?php echo $item['instr_text']; ?></p>
        </li>
        <?php endforeach; ?>
    </ol>
    <?php endif; ?>
</div>
<?php get_footer(); ?>