<?php

namespace HbgKiosk;

class App
{
    public function __construct()
    {
        add_filter('upload_mimes', array($this, 'allowSvg'));

        new PointOfInterest\CustomPostType();
        new Event\CustomPostType();
        new Screensaver\Screensaver();
        new Takeover\Takeover();

        new Admin\Ban();

        //Register hook
        add_action('import_cbis_event_hourly', array($this,'do_import_cbis_event'));

    }

    public function allowSvg($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }

	public static function add_cron_job () {
		wp_schedule_event(time(), 'hourly', 'import_cbis_event_hourly');
	}

	public static function remove_cron_job () {
		wp_clear_scheduled_hook('import_cbis_event_hourly');
	}

	public function do_import_cbis_event () {
		
		//Do import 
		new ParseCbis('http://familjenhelsingborg.se/cbisexport.csv');
		
		//Log when done 
		file_put_contents(dirname(__FILE__)."/log/cron_import_places.log", "Last run: ".date("Y-m-d H:i:s"));
		
	}

}