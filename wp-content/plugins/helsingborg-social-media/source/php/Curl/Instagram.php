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
        // Try to find the user id of the user with the given username
        $endpoint = 'https://api.instagram.com/v1/users/search';
        $data = array(
            'q' => $username,
            'client_id' => $this->key
        );

        $users = Helper::curl('GET', $endpoint, $data);
        $users = json_decode($users);

        $userId = null;

        foreach ($users->data as $user) {
            if ($user->username == $username) {
                $userId = $user->id;
                break;
            }
        }

        // Get the feed
        $endpoint = 'https://api.instagram.com/v1/users/' . $userId . '/media/recent/';
        $params = array(
            'client_id' => $this->key
        );

        $result = Helper::curl('GET', $endpoint, $params);
        $result = json_decode($result);

        return $result->data;
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
            'client_id' => $this->key
        );

        $result = Helper::curl('GET', $endpoint, $params);
        $result = json_decode($result);

        return $result->data;
    }
}
