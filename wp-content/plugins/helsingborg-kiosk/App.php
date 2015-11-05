<?php

namespace HbgKiosk;

class App
{
    public function __construct()
    {
        new PointOfInterest\CustomPostType();
        new Screensaver\Screensaver();
    }
}
