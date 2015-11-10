<?php
/*
    Plugin Name: Kiosk
    Description: Kom o köp
    Version: 1.0
    Author: Kristoffer Svanmark & Sebastian Thulin @ Helsingborg Stad
 */

define('HBG_KIOSK_TEMPLATE_FOLDER', 'hbg-kiosk');
define('HBG_KIOSK_PATH', plugin_dir_path(__FILE__));
define('HBG_KIOSK_URL', plugins_url('', __FILE__));

require_once HBG_KIOSK_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once HBG_KIOSK_PATH . 'public.php';

require_once HBG_KIOSK_PATH . 'source/acf/PoiCustomPostType.php';
require_once HBG_KIOSK_PATH . 'source/acf/PoiCategory.php';

// Instantiate and register the autoloader
$loader = new HbgKiosk\Vendor\Psr4ClassLoader();
$loader->addPrefix('HbgKiosk', HBG_KIOSK_PATH);
$loader->addPrefix('HbgKiosk', HBG_KIOSK_PATH . 'source/php/');
$loader->register();

// Start application
new HbgKiosk\App();
