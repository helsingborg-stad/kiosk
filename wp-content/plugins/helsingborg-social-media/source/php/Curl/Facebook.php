<?php

namespace HbgSocialMedia\Curl;

class Facebook
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
        $this->key = get_option('facebook_key');
        $this->secret = get_option('facebook_key_secret');

        // Here we need to authorize with the api I guess

        return true;
    }
}
