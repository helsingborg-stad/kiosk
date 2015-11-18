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
        
        //Cron stuff
        register_activation_hook(__FILE__, array($this,'add_cron_job'));
        register_deactivation_hook(__FILE__, array($this,'remove_cron_job'));
        
        //Register hook 
        add_action('import_cbis_event_hourly', array($this,'do_import_cbis_event'));
        
    }

    public function allowSvg($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }

	public function add_cron_job () {
		wp_schedule_event(time(), 'hourly', 'import_cbis_event_hourly');
	}
	
	public function remove_cron_job () {
		wp_clear_scheduled_hook('import_cbis_event_hourly');
	}
	
	public function do_import_cbis_event () {
		new ParseCbis('http://familjenhelsingborg.se/cbisexport.csv');
	}
	
}
