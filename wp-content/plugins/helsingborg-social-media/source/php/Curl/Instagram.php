<?php

namespace HbgSocialMedia\Curl;

class Instagram
{
    /**
     * Api keys and secrets
     * @var $key      Api key
     */
    private $key = null;

    public function __construct()
    {

    }

    /**
     * Authorizes with the api
     * @return boolean Always true
     */
    public function auth()
    {
        $this->key = null;
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

        $users = HbgCurl::request('GET', $endpoint, $data);
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

        $result = HbgSocialMedia\Helper\Curl::request('GET', $endpoint, $params);
        $result = json_decode($result);

        return $result->data;
    }

    /**
     * Get a hashtag feed
     * @param  string $hashtag The hashtag to get
     * @return object          The hastag recent media object
     */
    public function getHashtag($hashtag)
    {
        $endpoint = 'https://api.instagram.com/v1/tags/' . $hashtag . '/media/recent';
        $params = array(
            'client_id' => $this->key
        );

        $result = HbgSocialMedia\Helper\Curl::request('GET', $endpoint, $params);
        $result = json_decode($result);

        return $result->data;
    }
}
