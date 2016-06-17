<?php

namespace HbgKiosk\InstaGramStaticFeed;

class Instagram
{
    public function __construct()
    {
        add_action('wp_ajax_get_instagram_feed', array($this, 'returnJsonResponse'));
        add_action('wp_ajax_nopriv_get_instagram_feed', array($this, 'returnJsonResponse'));
    }

    public static function getClientId($post_id)
    {
    }

    public static function getFeed($client_id = null, $post_id = null)
    {
        if (is_null($client_id)) {
            $client_id = self::retriveClientId($post_id);
        }

        $endpoint   = 'https://api.instagram.com/v1/users/self/media/recent/';
        $recent     = \HbgKiosk\Helper\Curl::request('GET', $endpoint, array('access_token' => $client_id));

        return json_decode($recent);
    }

    public static function retriveClientId($post_id = null)
    {
        return get_post_meta($post_id, 'instagram_client_id', true);
    }

    public static function returnJsonResponse()
    {
        echo json_encode(self::getFeed(null, intval($_POST['post_id'])));
        die();
    }
}
