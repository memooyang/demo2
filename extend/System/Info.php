<?php
/*
\System\Info
*/
namespace System;

class Info
{
    /*
    PHP版本
    */
    public function getVersionPHP(){
        return PHP_OS . ' / PHP v' . PHP_VERSION;
    }
    /*
    Magic_Quotes_Gpc
    */
    public function getMagicQuotesGpc(){
        return get_magic_quotes_gpc() ? 'ON' : 'OFF';
    }
    /*
    最大上傳容量
    */
    public function getUploadMax(){
        return @ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'no data';
    }
    /*
    GD版本
    */
    public function getVersionGD(){
        return GD_VERSION;
    }
    /*
    Register_Globals
    */
    public function getRegisterGlobals(){
        return @ini_get('register_globals') ? 'ON' : 'OFF';
    }
    /*
    安全模式
    */
    public function getSaveMode(){
        return @ini_get('safe_mode') ? 'ON' : 'OFF';
    }
    /*
    GZIP壓缩支持
    */
    public function getGZIP(){
        return strstr($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip") ? 'ON' : 'OFF';
    }
    /*
    MySQL版本
    */
    public function getVersionMYSQL(){
        return mysql_get_server_info();
    }
    
    /*
    APACHE已載入之MODULES
    */
    public function getModules($module){
        $modules = apache_get_modules();
        return in_array($module, $modules);
    }

}