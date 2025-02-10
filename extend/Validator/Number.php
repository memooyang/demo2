<?php
/*
數字
\Validator\Number
*/
namespace Validator;

class Number
{
    /*
    @use
    \Validator\Number::check($data);
    */
    public static function check($data = '', $is_allow_empty = false){
        if(empty($data)){ return $is_allow_empty; }
        $is = is_numeric($data);
        return $is;
    }

}