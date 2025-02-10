<?php
/*
\Web\Params
*/
namespace Web;

class Params
{
    // const KEY = 'parameters';
    const KEY = 'xx';
    const IV = 'xx';

    /*
    參數加密/解密
    @params array $arr
    @params string $key
    */
    public static function encode($arr = array(), $key = '', $iv = '') 
    {
        if(empty($arr)){ return false; }
        if(empty($key)){ $key = self::KEY; }
        if(empty($iv)){ $key = self::IV; }
        // $str = '';
        // $str = http_build_query($arr);
        // $str = base64_encode($str);
        // $str = \Web\TokenHS256::encode($arr, $key);
        $str = \Web\TokenAES256::encode($arr, $key, $iv);
        return $str;
    }  
    
    public static function decode($str = '', $key = '', $iv = '') 
    {
        if(empty($key)){ $key = self::KEY; }
        if(empty($iv)){ $key = self::IV; }
        // $str = base64_decode($str);
        // $arr = array();
        // parse_str($str, $arr);
        // $arr = \Web\TokenHS256::decode($str, $key);
        $arr = \Web\TokenAES256::decode($str, $key, $iv);
        return $arr;
    }  
}
