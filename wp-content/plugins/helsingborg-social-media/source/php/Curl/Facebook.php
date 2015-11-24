<?php

namespace HbgSocialMedia\Curl;

use HbgSocialMedia\Curl\Provider;

class Facebook implements Provider
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
        $this->key = get_option('options_facebook_app_id');
        $this->secret = get_option('options_facebook_key_secret');

        // Here we need to authorize with the api I guess
        $endpoint = 'https://graph.facebook.com/oauth/access_token';
        $params = array(
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->key,
            'client_secret' => $this->secret
        );
        $token = Helper::curl('GET', $endpoint, $params);
        $this->accessToken = explode('=', $token)[1];

        return true;
    }
}
