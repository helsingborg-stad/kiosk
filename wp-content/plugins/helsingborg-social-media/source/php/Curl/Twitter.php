<?php

namespace HbgSocialMedia\Curl;

class Twitter
{
    public function __construct()
    {

    }

    /**
     * Gets a twitter feed of a specific username
     * @param  string $username  The twitter username to get
     * @param  integer $length   The max number of tweets to get
     * @return object            Object with the tweets
     */
    public function getTwitterFeed($username, $length) {
        /**
         * Get consumer key from options
         */
        $consumer_key    = get_option('hbgsf_twitter_consumer_key');
        $consumer_secret = get_option('hbgsf_twitter_consumer_secret');

        /**
         * Encode consumer key and secret
         */
        $consumer_key    = urlencode($consumer_key);
        $consumer_secret = urlencode($consumer_secret);

        /**
         * Concatenate key and secret and base64 encode
         */
        $bearer_token = $consumer_key . ':' . $consumer_secret;
        $base64_bearer_token = base64_encode($bearer_token);

        /**
         * Request access token
         */
        $endpoint = 'https://api.twitter.com/oauth2/token';

        // Request headers
        $headers = array(
            "POST /oauth2/token HTTP/1.1",
            "Host: api.twitter.com",
            "User-Agent: jonhurlock Twitter Application-only OAuth App v.1",
            "Authorization: Basic " . $base64_bearer_token,
            "Content-Type: application/x-www-form-urlencoded;charset=UTF-8"
        );

        // Postdata
        $data = array(
            'grant_type' => 'client_credentials'
        );

        // Curl and format response
        $response = HbgCurl::request('POST', $endpoint, $data, NULL, $headers);
        $response = json_decode($response);
        $access_token = $response->access_token;

        /**
         * Request statuses
         */
        $endpoint = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

        // Postdata
        $data = array(
            'access_token'     => $access_token,
            'screen_name'      => $username,
            'count'            => $length,
            'exclude_replies ' => true,
            'include_rts '     => false
        );

        // Request headers
        $headers = array(
            "GET /1.1/search/tweets.json" . http_build_query($data) . " HTTP/1.1",
            "Host: api.twitter.com",
            "User-Agent: jonhurlock Twitter Application-only OAuth App v.1",
            "Authorization: Bearer " . $access_token
        );

        // Curl
        $tweets = HbgCurl::request('GET', $endpoint, $data, 'JSON', $headers);

        return json_decode($tweets);
    }
}
