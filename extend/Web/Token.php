<?php
/*
\Web\Token
*/
namespace Web;

class Token
{
    
    public static function encode($payload = [])
    {
        // $token = \Web\TokenRS256::encode($payload);
        $token = \Web\Params::encode($payload);
        return $token;
    }
    
    public static function decode($token = '')
    {
        // $payload = \Web\TokenRS256::decode($token);
        if(strlen($token) < 15){ return false; }
        $payload = \Web\Params::decode($token);
        return $payload;
    }

}


