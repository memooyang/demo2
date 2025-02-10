<?php
/*
\Type\Number
*/
namespace Type;

class Number
{
    /*
    取得最小值 或 V1
    */
    public static function amount($v=0) 
    {
        if(empty($v)){ $v = 0; }
        $v = number_format($v);
        return $v;
    }

    /*
    取得最小值 或 V1
    */
    public static function money($v=0) 
    {
        if(empty($v)){ $v = 0; }
        $v = number_format($v);
        return $v;
    }
    
    /*
    取得最小值 或 V1
    */
    public static function getCompareMin($v1=0, $v2=0) 
    {
        if($v1 == $v2){ return $v1; }
        if($v1 > $v2){ return $v2; }
        if($v1 < $v2){ return $v1; }
        return false;
    }

    /*
    @use
        \Type\Number::json2str
    @params str : ["1","2","3","4"]
    @return 1,2,3,4,5
    */
    public static function json2str($str){
        if(empty($str)){ return ''; }
        $arr = json_decode($str, true);
        $str = implode(',', $arr);
        // if(empty($str)){ return '[]'; }
        // $str = "[{$str}]";
        return $str;
    }

    /*
    @use
        \Type\Number::onlyNumber
    @params str : (02)2945-9418
    @return 0229459418
    */
    public static function onlyNumber($str){
        if(empty($str)){ return ''; }
        $str = preg_replace("/[^0-9]/", "", $str);
        return $str;
    }
}