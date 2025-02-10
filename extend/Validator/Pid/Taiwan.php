<?php
/*
台灣身份證
\Validator\Pid\Taiwan
*/
namespace Validator\Pid;

class Taiwan
{
    /*
    @use
    \Validator\Pid\Taiwan::check($data);
    */
    public static function check($data = '', $is_allow_empty = false){
        if(empty($data)){ return false; };
        $data = strtoupper(trim($data)); //將英文字母全部轉成大寫，消除前後空白
        //檢查第一個字母是否為英文字，第二個字元1 2 A~D 其餘為數字共十碼
        //增加居留證檢核新規則 第二碼檢核 8與9 
        $pattern= "/^[A-Z]{1}[1289ABCD]{1}[[:digit:]]{8}$/"; 
        if(!preg_match($pattern, $data))return false;
        return true;
    }

}