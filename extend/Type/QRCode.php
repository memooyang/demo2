<?php
/*
\Type\QRCode
*/
namespace Type;

/*
集章QRCode
@example
https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=MQ%3D%3D
*/
class QRCode
{
    
    /*
    @use
    \Type\QRCode::encode($text);
    */
    public static function encode($text)
    {
        $v = urlencode(base64_encode($text));
        return $v;
    }
    
    /*
    @use
    \Type\QRCode::decode($text);
    */
    public static function decode($text)
    {
        $v = base64_decode(urldecode($text));
        return $v;
    }
    
}