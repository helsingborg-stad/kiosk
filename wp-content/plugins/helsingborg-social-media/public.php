<?php

/**
 * Get instagram hashtag feed
 */
if (!function_exists('get_instagram_hashtag')) {
    function get_instagram_hashtag($hashtag, $length = 8, $exclude = null) {
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');

        if (is_plugin_active('helsingborg-social-media/helsingborg-social-media.php')) {
            $parser = new \HbgSocialMedia\Curl\Instagram;
            $parser->auth();
            $data = $parser->getHashtag($hashtag);

            $result = \HbgSocialMedia\Normalizer::normalize('instagram', $data);

            // Exclusion filter
            if (is_array($exclude) && count($exclude) > 0) {
                $result = array_filter($result, function ($item) use ($exclude) {
                    return !in_array($item->id, $exclude);
                });
            }

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
    function get_twitter_hashtag($hashtag, $length = 8, $exclude = null) {
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');

        if (is_plugin_active('helsingborg-social-media/helsingborg-social-media.php')) {
            $parser = new \HbgSocialMedia\Curl\Twitter;
            $parser->auth();
            $data = $parser->getHashtag($hashtag);

            $result = \HbgSocialMedia\Normalizer::normalize('twitter', $data);

            // Exclusion filter
            if (is_array($exclude) && count($exclude) > 0) {
                $result = array_filter($result, function ($item) use ($exclude) {
                    return !in_array($item->id, $exclude);
                });
            }

            $result = array_slice($result, 0, $length);

            return $result;
        } else {
            return false;
        }
    }
}