<?php

namespace HbgKiosk\Screensaver;

class Screensaver
{
    public function __construct()
    {
        add_action('init', array($this, 'addSettingsPage'));
        add_action('hbg-kiosk-screensaver', array($this, 'outputScreensaver'));
    }

    /**
     * Adds the settings page for the screensaver functionallity
     */
    public function addSettingsPage()
    {
        $icon = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCAyMjEgMjM0IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAyMjEgMjM0OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8cGF0aCBkPSJNMTg3LjYsMTg0Yy02Mi42LDAtMTEzLjQtNTAuOC0xMTMuNC0xMTMuNGMwLTI0LjUsNy44LTQ3LjMsMjEuMS02NS44Yy00OC45LDEyLjYtODUuMSw1Ny04NS4xLDEwOS44DQoJYzAsNjIuNiw1MC44LDExMy40LDExMy40LDExMy40YzM4LjEsMCw3MS44LTE4LjgsOTIuMy00Ny42QzIwNi45LDE4Mi44LDE5Ny40LDE4NCwxODcuNiwxODR6IE01NC43LDYyLjkNCgljLTcuOSwxMS41LTEzLjQsMjQtMTYuNSwzNy42Yy0yLjIsOS40LTE2LjYsNS40LTE0LjUtNGMzLjQtMTQuNyw5LjUtMjguNywxOC00MS4yQzQ3LjIsNDcuNCw2MC4yLDU0LjksNTQuNyw2Mi45eiIvPg0KPHBvbHlnb24gcG9pbnRzPSIxNDUuMyw0OS40IDE1MC40LDY0LjEgMTY1LjIsNjkgMTUwLjQsNzQuMSAxNDUuNSw4OC45IDE0MC41LDc0LjEgMTI1LjcsNjkuMiAxNDAuNCw2NC4yICIvPg0KPHBvbHlnb24gcG9pbnRzPSIxMjUuMywxMDEuNCAxMjguNiwxMTAuOCAxMzguMSwxMTQgMTI4LjYsMTE3LjIgMTI1LjUsMTI2LjcgMTIyLjIsMTE3LjMgMTEyLjcsMTE0LjEgMTIyLjIsMTEwLjkgIi8+DQo8cG9seWdvbiBwb2ludHM9IjEwNi44LDY1LjkgMTEwLjksNzcuOSAxMjMsODIgMTExLDg2LjEgMTA3LDk4LjIgMTAyLjgsODYuMSA5MC43LDgyLjEgMTAyLjgsNzggIi8+DQo8cG9seWdvbiBwb2ludHM9IjEyNS4zLDMxLjQgMTI4LjYsNDAuOCAxMzguMSw0NCAxMjguNiw0Ny4yIDEyNS41LDU2LjcgMTIyLjIsNDcuMyAxMTIuNyw0NC4xIDEyMi4yLDQwLjkgIi8+DQo8L3N2Zz4NCg==';

        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(array(
                'page_title'    => 'Screensaver',
                'menu_title'    => 'Screensaver',
                'menu_slug'     => 'screensaver',
                'capability'    => 'edit_posts',
                'icon_url'      => $icon,
                'position'      => 30.3,
                'redirect'      => false
            ));
        }
    }

    public function outputScreensaver()
    {
        $screensaverMedia = json_decode(json_encode(get_field('screensaver-media', 'option')));
        require \HbgKiosk\Helper\Wp::getTemplate('screensaver-base');
    }
}
