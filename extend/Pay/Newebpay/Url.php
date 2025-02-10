<?php
/*
\Pay\Newebpay\Url
*/
namespace Pay\Newebpay;

class Url
{
    public static $urlMpg = [
        'prod' => 'https://core.newebpay.com/MPG/mpg_gateway',
        'dev' => 'https://ccore.newebpay.com/MPG/mpg_gateway',
    ];
    
    /*
    @use
    \Pay\Newebpay\Url::getMpg
    */
    public static function getMpg($is_dev = 0){
        if($is_dev){
            return self::$urlMpg['dev'];
        }else{
            return self::$urlMpg['prod'];
        }
    }
    
}