<?php
/*
手機號碼
\Validator\Tel
*/
namespace Validator;

class Tel
{
    /*
    @tip
    (02)2222-1231#123
    @use
    \Validator\Tel::check($data);
    */
    public static function check($data = '', $is_allow_empty = false){
        if(empty($data)){ return $is_allow_empty; }
        if(preg_match("/^[0-9\-\(\)\+\#]+$/", $data)) {
            return true;  
        } else {
            return false;
        }
    }

}