<?php
/*
發票統一編號
\Validator\Pid\Invoice
*/
namespace Validator\Pid;

class Invoice
{
    /*
    @use
    \Validator\Pid\Invoice::check($data);
    */
    public static function check($data = '', $is_allow_empty = false){
        if(empty($data)){ return false; };
        $is = is_numeric($data);
        $len = strlen($data);
        if($len != 8){ $is = false; }
        return $is;
    }

}