<?php

namespace HbgKiosk\Admin;

class Ban
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'registerBanPage'), 100);
    }

    public function registerBanPage()
    {
        add_submenu_page(
            'social-media-settings',
            'Banna bilder',
            'Banna bilder',
            'administrator',
            'social-media-ban',
            function () {

                if (isset($_POST['social-media-ban'])) {
                    $this->save($_POST);
                }

                $blocked = get_option('social_media_blocked_ids');

                $hashtags = get_field('screensaver-media', 'option');
                $hashtags = json_decode(json_encode(array_filter($hashtags, function ($item) {
                    $allowed = array('screensaver-twitter', 'screensaver-instagram');
                    return in_array($item['acf_fc_layout'], $allowed);
                })));

                require_once HBG_KIOSK_PATH . '/views/ban.php';
            }
        );
    }

    public function save($post)
    {
        $blocked = get_option('social_media_blocked_ids');

        $blocked = array_filter($blocked, function ($item) use ($post) {
            return !in_array($item, $post['ids']);
        });

        // Set blocked id's
        foreach ($post['block'] as $id) {
            $blocked[] = $id;

            update_option('social_media_blocked_ids', $blocked);
        }
    }
}