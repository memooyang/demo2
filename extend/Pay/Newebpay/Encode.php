<?php
/*
\Pay\Newebpay\Encode
*/
namespace Pay\Newebpay;

class Encode
{
    const KEY = 'localhost-key';
    const IV = 'localhost-iv';
    
    public static function encode($payload = [], $key = '', $iv = '')
    {
        //-----
        if(empty($key)){ $key = self::KEY; }
        if(empty($iv)){ $iv = self::IV; }
        // _json($key);
        $token = bin2hex(openssl_encrypt($payload, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv));
        return $token;
    }
}