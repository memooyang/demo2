<?php
/*
\Web\Locale
*/
namespace Web;

class Locale
{
    
    //array('zh-cn','zh-tw','en');
    // const DEFAULT_LOCALE = 'zh-tw'; //zh-cn, en
    
    public static $locale = null; //OBJECT self
    public static $serialize = null; //string //unserialize to OBJECT

    /*
    初始化語系區域及字詞 Translate
    */
    public static function initLanguage($locale)
    {
        return true;
    }
    
    /*
    序列化並取得目前區域資料 
    @return string
    */
    public static function serialize()
    {
        if(!(isset(self::$locale))){ 
            self::$locale = new self(); 
        }
        self::$serialize = self::$locale->serialize();
        return self::$serialize;
    }
    
    /*
    序列化目前區域資料 
    @return string
    */
    public static function unserialize()
    {
        $locale = unserialize(self::$locale);
        return $locale;
    }
    
    /*
    設定目前使用的區域語系
    @params string $key
    @return none
    */
    public static function setLanguage($language)
    {
        if(empty($language)){
            $language = \Env::get('DEFAULT_LANG', 'zh-tw');
        }
        \Web\Session::setLanguage($language);
    }
    
    /*
    設定目前使用的區域語系
    @params string $key
    @return none
    */
    public static function initLocale($locale)
    {
        if(empty($locale)){
            $locale = self::getLocale();
        }
        if(empty($locale)){
            $locale = self::getDefaultLocale();
        }
        \Web\Session::setLocale($locale);
    }
    
    /*
    設定目前使用的區域語系
    @params string $key
    @return none
    */
    public static function setLocale($locale, $time = '')
    {
        if(empty($locale)){
            $locale = self::getDefaultLocale();
        }
        if(empty($time)){
            // 20 days = 20*24*60*60 seconds
            $time = time()+20*24*60*60;
        }
        \Web\Session::setLocale($locale);
        \Web\Session::setLanguage($locale);
        setcookie('locale', $locale, $time);
        return $locale;
    }
    
    /*
    設定目前使用的區域語系
    @params string $key
    @return none
    */
    public static function setCustomLocale($locale, $time = '')
    {
        if(empty($locale)){
            $locale = self::getDefaultLocale();
        }
        if(empty($time)){
            // 20 days = 20*24*60*60 seconds
            $time = time()+20*24*60*60;
        }
        \Web\Session::setCustomLocale($locale);
        \Web\Session::setCustomLanguage($locale);
        \Web\Session::setCustomCurrency($locale);
        setcookie('custom_locale', $locale, $time);
        return $locale;
    }
    
    /*
    取得目前使用的區域語系
    @return string
    */
    public static function getLocale()
    {
        $locale = \Web\Session::getLocale();
        return $locale; 
    }
    
    /*
    取得預設使用的區域 / BY Browser
    // Return only browser locales
    @return array
    */
    public static function getDefaultLocale()
    {
        // $response = \IpLocation::whereAmI();
        // $locale = $response['locale'];
        if(empty($locale)){
            $locale = \Env::get('DEFAULT_LANG', 'zh-tw');
        }
        return $locale;
    }

    /*
    判斷 KEY 是否為Locale
    @params string $key
    @params boolean $is_strict
    @return boolean
    */
    public static function isLocale($key, $is_strict=false)
    {

        if (self::isLocale($key, $is_strict)) {
            return true;
        } else {
            return false;
        }
        
    }
 
}
