<?php

namespace HbgSocialMedia;

class Normalizer
{
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

    /**
     * Normalize instagram response
     * @param  object $data The data
     * @return object       The normalized data
     */
    public static function instagram($data)
    {
        $normalized = array();

        foreach ($data as $item) {
            $normalized[] = array(
                'id' => $item->id,
                'type' => 'instagram',
                'user' => $item->user->username,
                'created_time' => $item->created_time,
                'image' => $item->images->standard_resolution->url
            );
        }

        return $normalized;
    }

    public static function twitter($data)
    {
        $normalized = array();

        foreach ($data as $item) {
            $image = null;

            if (is_array($item->entities->media)) {
                foreach ($item->entities->media as $media) {
                    if ($media->type == 'photo') {
                        $image = $media->media_url;
                    }
                }
            }

            if (!is_null($image)) {
                $normalized[] = array(
                    'id' => $item->id,
                    'type' => 'twitter',
                    'user' => $item->user->screen_name,
                    'created_time' => strtotime($item->created_at),
                    'image' => $image
                );
            }
        }

        return $normalized;
    }
}
