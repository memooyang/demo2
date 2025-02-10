<?php
/*
\Web\Alert
即時訊息輸出
存在Session / 調用訊息後清空
*/
namespace Web;

class Alert
{
    public static function have($session_key = '', $key = 'data')
    {
        self::haveMessage($session_key, $key);
    }
    
    public static function haveMessage($session_key = '', $key = 'data')
    {
        if(empty($session_key)){ $session_key = \Web\Session::ALERT; }
        $session_key = \Web\Session::buildSessionKey($session_key);
        if(empty($_SESSION[$session_key][$key])){
            return false;
        }else{
            return true;
        }
    }
    
    public static function _($data = '', $session_key = '', $key = 'data')
    {
        self::message($data, $session_key, $key);
    }
    
    public static function output($data = '', $session_key = '', $key = 'data')
    {
        self::message($data, $session_key, $key);
    }
    
    /*
    @set
    \Alert::message('test');
    @get
    \Alert::message();
    */
    public static function message($data = '', $session_key = '', $key = 'data')
    {
        if(empty($session_key)){ $session_key = \Web\Session::ALERT; }
        $session_key = \Web\Session::buildSessionKey($session_key);
        if(!(empty($data))){ 
            if(is_object($data)){
                $data = $data->getMessage();
            }else if(is_array($data)){
                $data = $data['message'];
            }else{
                $data = $data;
            }
            $data = __($data);
            $_SESSION[$session_key][$key] = $data; 
            $temp = $data;
        }else{
            $temp = $_SESSION[$session_key][$key];
            // $session_msg->$key = '';
            // unset($session_msg->$key);
            $_SESSION[$session_key][$key] = '';
        }
        
        return $temp;
    }

    /*
    @param Array data 
    (
        code,
        topic,
        content
        url
        time
    )
    */
    public static function haveException($key = 'data')
    {
        $session_key = \Web\Session::ALERT_EXCEPTION;
        $session_key = \Web\Session::buildSessionKey($session_key);
        if(empty($_SESSION[$session_key][$key])){
            return false;
        }else{
            return true;
        }
    }
    public static function exception($data = '', $session_key = '', $key = 'data')
    {
        $temp = self::message($data, \Web\Session::ALERT_EXCEPTION, $key = 'data');
        return $temp;
    }
    
    public static function haveError($key = 'data')
    {
        $session_key = \Web\Session::ALERT_ERROR;
        $session_key = \Web\Session::buildSessionKey($session_key);
        if(empty($_SESSION[$session_key][$key])){
            return false;
        }else{
            return true;
        }
    }
    public static function error($data = '', $session_key = '', $key = 'data')
    {
        $temp = self::message($data, \Web\Session::ALERT_ERROR, $key = 'data');
        return $temp;
    }
    
    public static function haveSuccess($key = 'data')
    {
        $session_key = \Web\Session::ALERT_SUCCESS;
        $session_key = \Web\Session::buildSessionKey($session_key);
        if(empty($_SESSION[$session_key][$key])){
            return false;
        }else{
            return true;
        }
    }
    public static function success($data = '', $session_key = '', $key = 'data')
    {
        $temp = self::message($data, \Web\Session::ALERT_SUCCESS, $key = 'data');
        return $temp;
    }
    
    public static function haveInfo($key = 'data')
    {
        $session_key = \Web\Session::ALERT_INFO;
        $session_key = \Web\Session::buildSessionKey($session_key);
        if(empty($_SESSION[$session_key][$key])){
            return false;
        }else{
            return true;
        }
    }
    public static function info($data = '', $session_key = '', $key = 'data')
    {
        $temp = self::message($data, \Web\Session::ALERT_INFO, $key = 'data');
        return $temp;
    }
    
    public static function haveWarning($key = 'data')
    {
        $session_key = \Web\Session::ALERT_WARNING;
        $session_key = \Web\Session::buildSessionKey($session_key);
        if(empty($_SESSION[$session_key][$key])){
            return false;
        }else{
            return true;
        }
    }
    public static function warning($data = '', $session_key = '', $key = 'data')
    {
        $temp = self::message($data, \Web\Session::ALERT_WARNING, $key = 'data');
        return $temp;
    }
    
}


