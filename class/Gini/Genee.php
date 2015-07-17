<?php


class Genee {

    public static function setup() {
        setlocale(LC_MONETARY, \Gini\Config::get('system.locale') ?: 'zh_CN');
        \Gini\I18N::setup();
    }
    
}
