<?php
/*
\Session\UrlByScanToken
*/
namespace Session;

class UrlByScanToken
{
    const KEY = 'UrlByScanToken';
    public static function _set($arg0 = '', $arg1 = ''){ return \Session::_set(self::KEY, $arg0, $arg1); }
    public static function _get($key = ''){ $d = \Session::_get(self::KEY, $key); $d = ($d)?$d:[]; return $d; }
    public static function _clear(){ return \Session::_clear(self::KEY); }
    public static function pop($key = ''){ 
        $d = self::_get($key); \Session::_clear(self::KEY); 
        return $d;
    }
}