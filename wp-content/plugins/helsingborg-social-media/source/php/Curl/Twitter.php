<?php

namespace HbgSocialMedia\Curl;

class Twitter
{
    /**
     * Api keys and secrets
     * @var string $key      Api key
     * @var string $secret   Api secret
     */
    private $key = null;
    private $secret = null;

    /**
     * Holds the access token when authorized
     * @var string
     */
    private $accessToken = null;

    /**
     * Authorize with the api
     * @return boolean Always returns true at the moment
     */
    public function auth()
    {
        // Get the consumer key and secret from options
        $this->key = get_option('options_twitter_key');
        $this->secret = get_option('options_twitter_key_secret');

        // Create bearer token
        $bearerToken = $this->key . ':' . $this->secret;
        $base64BearerToken = base64_encode($bearerToken);

        // Request access token
        $endpoint = 'https://api.twitter.com/oauth2/token';

        $headers = array(
            "POST /oauth2/token HTTP/1.1",
            "Host: api.twitter.com",
            "User-Agent: jonhurlock Twitter Application-only OAuth App v.1",
            "Authorization: Basic " . $base64BearerToken,
            "Content-Type: application/x-www-form-urlencoded;charset=UTF-8"
        );

        $params = array(
            'grant_type' => 'client_credentials'
        );

        $response = Helper::curl('POST', $endpoint, $params, null, $headers);
        $response = json_decode($response);

        // Set the access token
        $this->accessToken = $response->access_token;
        return true;
    }

    /**
     * Gets the feed of a specific user
     * @param  string $username  The twitter username to get
     * @param  integer $length   The max number of tweets to get
     * @return object            Object with the tweets
     */
    public function getUserFeed($username, $length = 10)
    {
        // Request statuses
        $endpoint = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

        // Postdata
        $params = array(
            'access_token'     => $this->accessToken,
            'screen_name'      => $username,
            'count'            => $length,
            'exclude_replies ' => true,
            'include_rts '     => false
        );

        // Request headers
        $headers = array(
            "GET /1.1/search/tweets.json" . http_build_query($params) . " HTTP/1.1",
            "Host: api.twitter.com",
            "User-Agent: jonhurlock Twitter Application-only OAuth App v.1",
            "Authorization: Bearer " . $this->accessToken
        );

        // Curl
        $tweets = Helper::curl('GET', $endpoint, $data, 'JSON', $headers);

        return json_decode($tweets);
    }

    /**
     * Get a hashtag feed (recent media)
     * @param  string $hashtag The hashtag to get
     * @return object          The hastag recent media object
     */
    public function getHashtag($hashtag, $length = 20)
    {
        $endpoint = 'https://api.twitter.com/1.1/search/tweets.json';

        // Postdata
        $params = array(
            'access_token'     => $this->accessToken,
            'q'                => '#' . $hashtag,
            'count'            => $length,
            'result_type'      => 'recent',
            'exclude_replies ' => true,
            'include_rts '     => false
        );

        // Request headers
        $headers = array(
            "GET /1.1/search/tweets.json" . http_build_query($params) . " HTTP/1.1",
            "Host: api.twitter.com",
            "User-Agent: jonhurlock Twitter Application-only OAuth App v.1",
            "Authorization: Bearer " . $this->accessToken
        );

        // Curl
        $tweets = Helper::curl('GET', $endpoint, $params, 'JSON', $headers);
        $tweets = json_decode($tweets);

        return $tweets->statuses;
    }
}
