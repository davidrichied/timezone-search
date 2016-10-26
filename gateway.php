<?php
foreach (glob(dirname(__FILE__) . '/lib/classes/*.php') as $classfilename) {
    include_once $classfilename;
}

$D2LCountryCodes = new D2LTimezone_Search();

class D2LTimezone_Search {
    private static $cache = array();

    private static $pluginBasename;

    private static $pluginUrl;

    public function __construct()
    {
        self::$pluginBasename = dirname( plugin_basename( __FILE__ ) );
        self::$pluginUrl = plugin_dir_url(__FILE__);
    }


    public static function manageScripts()
    {
        if (!isset(self::$cache['manageScripts'])) {
            self::$cache['manageScripts'] = new Timezone_Search_ManageScripts(self::$pluginUrl);
        }
        return self::$cache['manageScripts'];
    }

    public static function ajaxFunctions()
    {
        if (!isset(self::$cache['ajaxFunctions'])) {
            self::$cache['ajaxFunctions'] = new Timezone_Search_AjaxFunctions(self::curlWrap());
        }
        return self::$cache['ajaxFunctions'];
    }


    public static function curlWrap()
    {
        if (!isset(self::$cache['curlWrap'])) {
            self::$cache['curlWrap'] = new Timezone_Search_CurlWrap();
        }
        return self::$cache['curlWrap'];
    }


    public static function addShortcode()
    {
        if (!isset(self::$cache['addShortcode'])) {
            self::$cache['addShortcode'] = new Timezone_Search_AddShortcode();
        }
        return self::$cache['addShortcode'];
    }


    public static function mySettingsPage()
    {
        if (!isset(self::$cache['mySettingsPage'])) {
            self::$cache['mySettingsPage'] = new Timezone_Search_MySettingsPage();
        }
        return self::$cache['mySettingsPage'];
    }

}