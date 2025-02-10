<?php
/*
手機號碼
\Validator\Mobile
*/
namespace Validator;

class Mobile
{
    /*
    @tip
    09xxxxxxxx
    @use
    \Validator\Mobile::check($data);
    */
    public static function check($data = '', $is_allow_empty = false){
        if(empty($data)){ return $is_allow_empty; }
        if(preg_match("/^09[0-9]{8}$/", $data)) {
            return true;  
        } else {
            return false;
        }
    }

}