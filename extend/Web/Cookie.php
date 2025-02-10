<?php
/*
\Web\Cookie
*/
namespace Web;

class Cookie
{
    const IDENTITY              = 'COOKIE_IDENTITY'; //建立此瀏覽器的唯一識別碼
    const IDENTITY_MD5          = 'COOKIE_IDENTITY_MD5'; //建立此瀏覽器的唯一識別碼
    const SYSTEM                = 'COOKIE_SYSTEM';
    const USER                  = 'COOKIE_USER';
    const FORCE_LOGOUT          = 'FORCE_LOGOUT';
    
    public static function buildCookieKey($key = 'COOKIE_XXX')
    {
        if(empty($key)){ return false; }
        $host = $_SERVER['HTTP_HOST'];
        $key = $host.$key;
        $key = str_replace('.', '_', $key);
        return $key;
    }

    /*
    @param array
    */
    public static function setIdentityData($arg0 = array(), $time = '')
    {
        $data = \Web\Secrity::encodeParams($arg0);
        $key = self::IDENTITY;
        $key = self::buildCookieKey($key);
        $now = _date();
        // $expires = \Helper\Date\Add::hour(1, $now);
        $expires = \Helper\Date\Add::day(30, $now);
        header("Set-Cookie: {$key}={$data}; expires={$expires}; SameSite=None; Secure");
        
        // //-----md5
        // $key = self::IDENTITY_MD5;
        // $key = self::buildCookieKey($key);
        // $md5 = md5($data);
        // header("Set-Cookie: {$key}={$md5}; expires={$expires}; SameSite=None; Secure");
    }
    
    /*
    @return array
    */
    public static function touchIdentityData()
    {
        $arr = self::getIdentityData();
        if(empty($arr)){
            $arr = array();
            $arr['identity'] = uniqid();
            self::setIdentityData($arr);
        }
        return $arr;
    }
    public static function getIdentityData()
    {
        $key = self::IDENTITY;
        $key = self::buildCookieKey($key);
        $data = $_COOKIE[$key];
        $data = Xs_Secrity::decodeParams($data);
        return $data;
    }
    public static function getIdentityEncodedData()
    {
        $key = self::IDENTITY;
        $key = self::buildCookieKey($key);
        $data = $_COOKIE[$key];
        return $data;
    }
    
    public static function clearIdentityData()
    {
        $key = self::IDENTITY;
        $key = self::buildCookieKey($key);
        unset($_COOKIE[$key]);
        setcookie($key, '', time() - (3600*24*30)); 
    }

    /*
    System
    */
    public static function setSystemData($arg0 = array(), $time = '')
    {
        $data = \Web\Secrity::encodeParams($arg0);
        $key = self::SYSTEM;
        $key = self::buildCookieKey($key);
        $now = _date();
        $expires = \Helper\Date\Add::hour(24, $now);
        header("Set-Cookie: {$key}={$data}; expires={$expires}; SameSite=None; Secure");
    }
    
    public static function getSystemData()
    {
        $key = self::SYSTEM;
        $key = self::buildCookieKey($key);
        $data = $_COOKIE[$key];
        $data = Xs_Secrity::decodeParams($data);
        return $data;
    }
    
    public static function clearSystemData()
    {
        $key = self::SYSTEM;
        $key = self::buildCookieKey($key);
        unset($_COOKIE[$key]);
        setcookie($key, '', time() - 3600); 
    }

    /*
    User
    */
    public static function setUserData($arg0 = array(), $time = '')
    {
        $data = \Web\Secrity::encodeParams($arg0);
        $key = self::USER;
        $key = self::buildCookieKey($key);
        $now = _date();
        $expires = \Helper\Date\Add::day(30, $now);
        header("Set-Cookie: {$key}={$data}; expires={$expires}; SameSite=None; Secure");
    }
    
    public static function getUserData()
    {
        $key = self::USER;
        $key = self::buildCookieKey($key);
        $data = $_COOKIE[$key];
        $data = Xs_Secrity::decodeParams($data);
        return $data;
    }
    
    public static function clearUserData()
    {
        $key = self::USER;
        $key = self::buildCookieKey($key);
        unset($_COOKIE[$key]);
        setcookie($key, '', time() - (3600*24*30)); 
    }
}
