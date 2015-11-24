<?php

namespace HbgSocialMedia\Curl;

interface Provider
{
    /**
     * Authorize a user with the provider api
     * - Gets the $key and $secret from the backend
     * - Fills in the $accessToken variable
     * @return boolean
     */
    public function auth();

    /**
     * Gets a hashtag's recent media from the provider api
     * @return object The most recent media for the specific hashtag
     */
    public function getHashtag($hashtag);
}
