<?php
/*
電子發票 - 手機條碼
Mobile Barcode
\Validator\Mobile\Barcode
*/
namespace Validator\Mobile;

class Barcode
{
    /*
    電子發票 - 手機條碼
    驗證
    https://regex101.com/r/jsiWyz/1/codegen?language=php
    
    基本檢核邏輯:第1碼為【/】; 其餘7碼則由數字【0-9】大寫英文【A-Z】

                          與特殊符號【+】【-】【.】這39個字元組成的編號 

    商家需自行檢核:載具內容正確性
    
    @params
        $str = '/XXXXKP3'
    @use
    \Validator\Number\Barcode::check($data);
    */
    public static function check($str = '', $is_allow_empty = false){
        if(empty($data)){ return $is_allow_empty; }
        $re = '/^\/{1}[0-9A-Z.\-+]{7}$/m';
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
        $is = (!(empty($matches)))?true:false;
        return $is;
    }

}