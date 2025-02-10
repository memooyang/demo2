<?php
/*
網址
\Validator\Url
*/
namespace Validator;

class Url
{
    /*
    驗證URL
    @use
    \Validator\Url::check($data);
    */
    public static function check($data = '', $is_allow_empty = false){
        if(empty($data)){ return $is_allow_empty; }
        $is = filter_var($data, FILTER_VALIDATE_URL);
        return $is;
    }

}