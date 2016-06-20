<?php

namespace HbgSocialMedia\Curl;

use HbgSocialMedia\Curl\Provider;

class Instagram implements Provider
{
    /**
     * Api keys and secrets
     * @var $key      Api key
     */
    private $key = null;

    /**
     * Authorizes with the api
     * @return boolean Always true
     */
    public function auth()
    {
        $this->key = get_option('options_instagram_key_secret');
        return true;
    }

    /**
     * Gets a user's feed
     * @param  string $username The username of the user to get feed from
     * @return object           The feed object
     */
    public function getUserFeed($username)
    {
        $endpoint = 'https://www.instagram.com/'. $username .'/media/';
        $result = Helper::curl('GET', $endpoint, array());
        $result = json_decode($result);
        return $result->items;
    }

    /**
     * Get a hashtag feed (recent media)
     * @param  string $hashtag The hashtag to get
     * @return object          The hastag recent media object
     */
    public function getHashtag($hashtag)
    {
        $endpoint = 'https://api.instagram.com/v1/tags/' . $hashtag . '/media/recent';
        $params = array(
            'access_token' => $this->key
        );

        $result = Helper::curl('GET', $endpoint, $params);
        $result = json_decode($result);

        return $result->data;
    }
}
