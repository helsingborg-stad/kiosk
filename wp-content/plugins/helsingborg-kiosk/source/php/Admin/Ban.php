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
                $hashtags = get_field('screensaver-media', 'option');
                $hashtags = json_decode(json_encode(array_filter($hashtags, function ($item) {
                    $allowed = array('screensaver-twitter', 'screensaver-instagram');
                    return in_array($item['acf_fc_layout'], $allowed);
                })));

                require_once HBG_KIOSK_PATH . '/views/ban.php';
            }
        );
    }
}