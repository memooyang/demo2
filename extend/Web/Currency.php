<?php
/*
\Web\Currency
*/
namespace Web;

class Currency
{
    
    /*
    */
    public static function initCurrency($currency)
    {
        if(empty($currency)){
            $currency = self::getCurrency();
        }
        if(empty($currency)){
            $currency = self::getDefaultCurrency();
        }
        \Web\Session::setCurrency($currency);
        
        //TODO
        \Web\Session::setCurrency($currency);
    }
    
    /*
    */
    public static function setCurrency($currency)
    {
        if(empty($currency)){
            $currency = self::getDefaultCurrency();
        }
        \Web\Session::setCurrency($currency);
        return $currency;
    }
    
    /*
    */
    public static function getCurrency()
    {
        $currency = \Web\Session::getCurrency();
        return $currency; 
    }
    
    /*
    */
    public static function getDefaultCurrency()
    {
        $dataWeb = \Web::data();
        if($dataWeb){
            $currency = $dataWeb['currency']??'zh-tw';
        }else{
            $currency = 'zh-tw';
        }
        return $currency; 
    }
    
    public static function symbol($currency = 'zh-tw')
    {
        $symbol = '';
        switch($currency){
            default:
            case 'zh-tw':
            case 'zh_TW':
            case 'zh_tw':
            case 'tw':
            case 'TW':
            case 'twd':
            case 'TWD':
                $symbol = '$';
                break;
                
            case 'zh-cn':
            case 'zh_CN':
            case 'zh_cn':
            case 'cn':
            case 'CN':
            case 'cny':
            case 'CNY':
            case 'rmb':
            case 'RMB':
                $symbol = '¥';
                break;
        }
        return $symbol;
    }
    
}
