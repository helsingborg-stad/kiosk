<?php

namespace HbgKiosk\Takeover;

class Takeover
{
    public function __construct()
    {
        add_action('init', array($this, 'addSettingsPage'));
        add_action('wp_head', array($this, 'outputTakeover'));
    }

    /**
     * Adds the settings page for the screensaver functionallity
     */
    public function addSettingsPage()
    {
        $icon = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE4LjEuMSwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgMTYgMTYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDE2IDE2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8Zz4NCgk8cGF0aCBzdHlsZT0iZmlsbDojMDMwMTA0OyIgZD0iTTExLDNjMC4zNDYsMCwwLjY4MS0wLjAwNSwxLTAuMDA1QzExLjk5OSwxLjM0MSwxMC42NTcsMCw5LjAwMywwSDIuOTk3QzEuMzQyLDAsMCwxLjM0MiwwLDIuOTk3DQoJCXY2LjAwNkMwLDEwLjY1OCwxLjM0MiwxMiwyLjk5NywxMkgzdi0ySDIuOTk3QzIuNDUzLDEwLDIsOS41NTQsMiw5LjAwM1YyLjk5N0MyLDIuNDUzLDIuNDQ2LDIsMi45OTcsMmg2LjAwNg0KCQlDOS41NDcsMiwxMCwyLjQ0NiwxMCwyLjk5N1YzSDExeiIvPg0KCTxwYXRoIHN0eWxlPSJmaWxsOiMwMzAxMDQ7IiBkPSJNMTMuMDAzLDRINi45OTdDNS4zNDIsNCw0LDUuMzQyLDQsNi45OTd2Ni4wMDZDNCwxNC42NTgsNS4zNDIsMTYsNi45OTcsMTZoNi4wMDYNCgkJQzE0LjY1OCwxNiwxNiwxNC42NTgsMTYsMTMuMDAzVjYuOTk3QzE2LDUuMzQyLDE0LjY1OCw0LDEzLjAwMyw0eiBNMTQsMTMuMDAzQzE0LDEzLjU0NywxMy41NTQsMTQsMTMuMDAzLDE0SDYuOTk3DQoJCUM2LjQ1MywxNCw2LDEzLjU1NCw2LDEzLjAwM1Y2Ljk5N0M2LDYuNDUzLDYuNDQ2LDYsNi45OTcsNmg2LjAwNkMxMy41NDcsNiwxNCw2LjQ0NiwxNCw2Ljk5N1YxMy4wMDN6Ii8+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==';

        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(array(
                'page_title'    => 'Takeover',
                'menu_title'    => 'Takeover',
                'menu_slug'     => 'takeover',
                'capability'    => 'administrator',
                'icon_url'      => $icon,
                'position'      => 31.4,
                'redirect'      => false
            ));
        }
    }

    public function outputTakeover()
    {
        $takeovers = get_field('takeovers', 'option');
        $takeovers = json_encode($takeovers);

        echo '
            <script>
                var takeovers = ' . $takeovers . ';
            </script>
        ';
    }
}
