<?php
/*
\Validator\Role
*/
namespace Validator;

class Role
{
    /*
    Module Admin
    @tip
        case 'su':
        case 'admin':
        case 'manager':
    @use
    \Validator\Role::check($data);
    */
    public static function check($data = '', $is_allow_empty = false){
        $is = false;
        if(\Auth::isInternalAccount()){
            return self::checkBySu($data, $is_allow_empty);
        }else if(\Auth::isSu()){
            return self::checkBySu($data, $is_allow_empty);
        }else if(\Auth::isAdmin()){
            return self::checkByAdmin($data, $is_allow_empty);
        }else if(\Auth::isManager()){
            return self::checkByManager($data, $is_allow_empty);
        }
        return $is;
    }

    /*
    */
    public static function checkBySu($data = '', $is_allow_empty = false){
        $is = false;
        switch($data){
            case 'su':
            case 'admin':
            case 'manager':
                $is = true;
        }
        return $is;
    }

    /*
    */
    public static function checkByAdmin($data = '', $is_allow_empty = false){
        $is = false;
        switch($data){
            case 'admin':
            case 'manager':
                $is = true;
        }
        return $is;
    }

    /*
    */
    public static function checkByManager($data = '', $is_allow_empty = false){
        $is = false;
        switch($data){
            case 'manager':
                $is = true;
        }
        return $is;
    }

}