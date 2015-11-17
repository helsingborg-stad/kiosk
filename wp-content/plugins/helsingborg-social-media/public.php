<?php

function get_instagram_hashtag($hashtag, $length = 8) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');

    if (is_plugin_active('helsingborg-social-media/helsingborg-social-media.php')) {
        $instagram = new \HbgSocialMedia\Curl\Instagram;
        $instagram->auth();
        $data = $instagram->getHashtag($hashtag);

        $result = \HbgSocialMedia\Normalizer::normalize('instagram', $data);
        $result = array_slice($result, 0, $length);

        return $result;
    } else {
        return false;
    }
}

