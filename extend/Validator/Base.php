<?php
/*
網址
\Validator\Base
*/
namespace Validator;

class Base
{
    /*
    檢查變數是否為空 or 回傳預設值
    @use
    \Validator\Base::checkEmpty($data, $defaultValue)
    @params any $data
    @params any $defaultValue
    @return any

    */
    public static function checkEmpty($data, $defaultValue='')
    {
        if(empty($data)){
            return $defaultValue;
        }else{
            return $data;
        }
    }

    /*
    檢查變數是否為空 or 回傳預設值
    \Validator\Base::checkNull($data, $defaultValue)
    @params any $data
    @params any $defaultValue
    @return any

    */
    public static function checkNull($data, $defaultValue='')
    {
        if(!(isset($data))){
            return $defaultValue;
        }else{
            return $data;
        }
    }

}