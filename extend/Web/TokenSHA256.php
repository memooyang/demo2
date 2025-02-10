<?php
/*
\Web\TokenSHA256
*/
namespace Web;

class TokenSHA256
{
    const KEY = 'localhost-key';
    
    public static function encode($payload = [], $key = '')
    {
        //-----
        if(empty($key)){ $key = self::KEY; }
        // _json($key);
        $token = \Firebase\JWT\JWT::encode($payload, $key, 'HS256');
        return $token;
    }
    
    public static function decode($token = '', $key = '')
    {
        //-----
        if(empty($key)){ $key = self::KEY; }
        $payload = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key($key, 'HS256')); 
        // _json($payload);
        return $payload;
    }

}


