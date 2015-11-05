<?php

namespace HbgKiosk;

class App
{
    public function __construct()
    {
        new CustomPostType\PointOfInterest();

        //$parser = new Csv\Parse('/www/sites/kiosk/cbis_mat.csv');
    }
}
