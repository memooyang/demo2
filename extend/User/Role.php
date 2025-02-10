<?php
/*
\User\Role
*/
namespace User;

class Role
{
    public static $output = array(
        'su' => '超級管理員',
        'admin' => '高級管理員',
        'manager' => '一般管理員',
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