<style>
    .is-blocked {
        background: #B7102B !important;
        color: #fff !important;
        border-color: #630817 !important;
    }
</style>

<div class="wrap acf-settings-wrap">
    <h2>Banna bilder</h2>

    <form id="post" method="post">
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2">

                <!-- LEFT -->
                <div id="post-body-content">
                    <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                        <div id="normal-sortables" class="meta-box-sortables">

                            <?php
                            foreach ($hashtags as $hashtag) :
                                $network = null;
                                $media = null;

                                switch ($hashtag->acf_fc_layout) {
                                    case 'screensaver-twitter':
                                        $network = 'Twitter';
                                        $media = get_twitter_hashtag($hashtag->{'screensaver-hashtag'}, 50);
                                        break;

                                    case 'screensaver-instagram':
                                        $network = 'Instagram';
                                        $media = get_instagram_hashtag($hashtag->{'screensaver-hashtag'}, 50);
                                        break;
                                }
                            ?>
                            <div class="postbox acf-postbox">
                                <div class="handlediv" title="Klicka för att växla"><br></div>
                                <h3 class="hndle"><?php echo $network; ?>: #<?php echo $hashtag->{'screensaver-hashtag'}; ?></h3>
                                <div class="inside acf-fields -top">
                                    <ul>
                                        <?php foreach ($media as $item) : ?>
                                        <li style="display:inline-block;border: 1px solid #EEEEEE;padding: 10px;margin: 10px;position: relative;">
                                            <img src="<?php echo $item->image; ?>" alt="" width="180" height="180">
                                            <label style="display:block;background:#fff;border:1px solid #eee;padding:5px 8px;position: absolute; bottom: 10px; right: -5px;" <?php if (in_array($item->id, $blocked)) : ?>class="is-blocked"<?php endif; ?>>
                                                <input type="checkbox" name="block[]" value="<?php echo $item->id; ?>" <?php if (in_array($item->id, $blocked)) : ?>checked<?php endif; ?>> Blockera
                                            </label>
                                            <input type="hidden" name="ids[]" value="<?php echo $item->id; ?>">
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

                <!-- RIGHT -->
                <div id="postbox-container-1" class="postbox-container">
                    <div class="meta-box-sortables ui-sortable" id="side-sortables">
                        <!-- Update -->
                        <div class="postbox" id="submitdiv">
                            <h3 style="border-bottom:none;" class="hndle"><span>Spara</span></h3>
                            <div id="major-publishing-actions">
                                <div id="publishing-action">
                                    <span class="spinner"></span>
                                    <input type="submit" name="social-media-ban" id="publish" class="button button-primary button-large" value="Spara alternativ" accesskey="p">
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>

                        <div class="meta-box-sortables" id="side-sortables"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('input[name*="block"]').on('change', function (e) {
            console.log("HEJ");
            if ($(this).is(':checked')) {
                $(this).parent('label').addClass('is-blocked');
            } else {
                $(this).parent('label').removeClass('is-blocked');
            }
        });
    });
</script>