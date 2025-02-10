<?php
/*
\Web\Flash
即時訊息輸出
存在Session / 調用訊息後清空
*/
namespace Web;

class Flash
{
    const SESSION_KEY = 'SESSION_FLASH_SESSION';
    
    public function output($data=null, $key='default')
    {
        if(isset($data)){
            $_SESSION[self::SESSION_KEY][__FUNCTION__][$key] = $data;
            return;
        }else{
            $_data = $_SESSION[self::SESSION_KEY][__FUNCTION__][$key];
            return $_data;
        }
    }
    
    public function error($data=null)
    {
        if(isset($data)){
            $_SESSION[self::SESSION_KEY][__FUNCTION__] = $data;
            return;
        }else{
            $_data = $_SESSION[self::SESSION_KEY][__FUNCTION__];
            return $_data;
        }
    }
    
    public function success($data=null)
    {
        if(isset($data)){
            $_SESSION[self::SESSION_KEY][__FUNCTION__] = $data;
            return;
        }else{
            $_data = $_SESSION[self::SESSION_KEY][__FUNCTION__];
            return $_data;
        }
    }
}


