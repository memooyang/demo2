<?php
/*
\Type\Boolean
*/
namespace Type;

class Boolean
{
    /*
    解析來源 / 有資料:1 / 無資料:0
    @param boolean $src
    @return int 0/1
    */
    public static function parseToNumber($src)
    {
        if(is_bool($src) && $src){ return '1'; }else{ return '0'; }
    }

    /*
    解析來源 / 有資料:1 / 無資料:0
    @param boolean $src
    @return int 0/1
    */
    public static function parseToYesNoByNumber($src)
    {
        if(empty($src)){ return __('否'); }else{ return __('是'); }
    }
    
}