<?php
/*
\Web\TokenRS256
*/
namespace Web;

class TokenRS256
{
    public static $PRIVATE_KEY = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
-----END RSA PRIVATE KEY-----
EOD;

    public static $PUBLIC_KEY = <<<EOD
-----BEGIN PUBLIC KEY-----
-----END PUBLIC KEY-----
EOD;
    
    public static function encode($payload = [])
    {
        $publicKey = self::$PUBLIC_KEY;
        $privateKey = self::$PRIVATE_KEY;
        $token = \Firebase\JWT\JWT::encode($payload, $privateKey, 'RS256');
        return $token;
    }
    
    public static function decode($token = '')
    {
        $publicKey = self::$PUBLIC_KEY;
        $privateKey = self::$PRIVATE_KEY;
        $payload = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key($publicKey, 'RS256')); 
        // \Debug::json($payload);
        return $payload;
    }

}


