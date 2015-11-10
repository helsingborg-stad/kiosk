<?php

namespace HbgKiosk;

class App
{
    public function __construct()
    {
        add_filter('upload_mimes', array($this, 'allowSvg'));

        new PointOfInterest\CustomPostType();
        new Screensaver\Screensaver();
    }

    public function allowSvg($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
}
