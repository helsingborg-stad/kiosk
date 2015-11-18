<?php

/**
 * Get instagram hashtag feed
 */
if (!function_exists('get_instagram_hashtag')) {
    function get_instagram_hashtag($hashtag, $length = 8) {
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');

        if (is_plugin_active('helsingborg-social-media/helsingborg-social-media.php')) {
            $parser = new \HbgSocialMedia\Curl\Instagram;
            $parser->auth();
            $data = $parser->getHashtag($hashtag);

            $result = \HbgSocialMedia\Normalizer::normalize('instagram', $data);
            $result = array_slice($result, 0, $length);

            return $result;
        } else {
            return false;
        }
    }
}

/**
 * Get Twitter hashtag feed
 */
if (!function_exists('get_twitter_hashtag')) {
    function get_twitter_hashtag($hashtag, $length = 8) {
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');

        if (is_plugin_active('helsingborg-social-media/helsingborg-social-media.php')) {
            $parser = new \HbgSocialMedia\Curl\Twitter;
            $parser->auth();
            $data = $parser->getHashtag($hashtag);

            $result = \HbgSocialMedia\Normalizer::normalize('twitter', $data);
            $result = array_slice($result, 0, $length);

            return $result;
        } else {
            return false;
        }
    }
}