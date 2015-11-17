<?php

namespace HbgSocialMedia;

class Normalizer
{
    public function __construct()
    {

    }

    /**
     * Normalizes api response data to our own format of choise
     * @param  string $type Tells what type of data we are receiving
     * @param  object $data The data
     * @return object       The normalized data
     */
    public static function normalize($type, $data)
    {
        $normalized = false;

        switch ($type) {
            case 'instagram':
                $normalized = self::instagram($data);
                break;

            /*
            case 'facebook':
                $normalized = self::facebook($data);
                break;
            */

            case 'twitter':
                $normalized = self::twitter($data);
                break;
        }

        return json_decode(json_encode($normalized));
    }

    public static function instagram($data)
    {
        $normalized = array();

        foreach ($data as $item) {
            $normalized[] = array(
                'user' => $item->user->username,
                'created_time' => $item->created_time,
                'image' => $item->images->standard_resolution->url
            );
        }

        return $normalized;
    }
}
