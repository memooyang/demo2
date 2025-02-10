<?php
/*
\Type\SerialNumber
*/
namespace Type;

class SerialNumber
{

    /*
    產生會員編號...etc
    @use
        \Type\SerialNumber::make(123, 6);
    */
    public static function make($your_sn = 1, $length = 3)
    {
        $sn = sprintf("%0{$length}d", $your_sn);   
        return $sn;
    }
}