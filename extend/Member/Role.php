<?php
/*
\Member\Role
*/
namespace Member;

class Role
{
    public static $output = array(
        'member' => '會員',
    );
    
    public static function output($key){
        if(empty($key)){ return ''; }
        $text = '';
        switch($key){
            default:
                $text = self::$output[$key]??null;
                break;
            
        }
        return $text;
    }
}