<?php

namespace Gini\Module;

class Genee {

    public static function setup() {

        date_default_timezone_set(\Gini\Config::get('system.timezone') ?: 'Asia/Shanghai');

        class_exists('\Gini\Those');

        setlocale(LC_MONETARY, \Gini\Config::get('system.locale') ?: 'zh_CN');
        \Gini\I18N::setup();

        $composer_path = \Gini\Core::locateFile("vendor/autoload.php","genee");
 		require_once($composer_path);
    }
    
}
