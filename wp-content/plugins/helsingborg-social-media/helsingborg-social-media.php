<?php
/*
    Plugin Name: Sociala medier
    Description: Funktioner inom sociala medier
    Version: 1.0
    Author: Kristoffer Svanmark & Sebastian Thulin @ Helsingborg Stad
 */

define('HBG_SOCIAL_MEDIA_TEMPLATE_FOLDER', 'hbg-kiosk');
define('HBG_SOCIAL_MEDIA_PATH', plugin_dir_path(__FILE__));
define('HBG_SOCIAL_MEDIA_URL', plugins_url('', __FILE__));

// Requires
require_once HBG_SOCIAL_MEDIA_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once HBG_SOCIAL_MEDIA_PATH . 'public.php';

// Instantiate and register the autoloader
$loader = new HbgSocialMedia\Vendor\Psr4ClassLoader();
$loader->addPrefix('HbgSocialMedia', HBG_SOCIAL_MEDIA_PATH);
$loader->addPrefix('HbgSocialMedia', HBG_SOCIAL_MEDIA_PATH . 'source/php/');
$loader->register();

// Start application
new HbgSocialMedia\App();
