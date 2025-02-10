<?php
/*
\Rdb\Web
*/
namespace Rdb;

use Rdb\Base;

class Web extends Base
{
    public $tableName = 'web';
    
    public static $modes = array(
        'dev' => ['name'=>'開發站'],
        'demo' => ['name'=>'測試站'],
        'prod' => ['name'=>'正式站'],
    );
    
    public function prepare($row)
    {
        if(empty($row)){ return false; }
        $row = parent::prepare($row);
        
        $row['__OUTPUT__']['name'] = ($row['name']);
        $row['__OUTPUT__']['name-1'] = mb_substr($row['name'],0,1);
        $row['__OUTPUT__']['name-1'] = $row['__OUTPUT__']['name-1']??'';
        
        //-----!important
        $mode = \Env::get('WEB_MODE', $row['mode']);
        $domain_field = "domain_{$mode}";
        if(array_key_exists($domain_field, $row)){
            $domain = $row[$domain_field];
            $row['domain'] = $domain;
        }
        if($row['domain']){ 
            $row['__OUTPUT__']['domain'] = \Type\Str::host($row['domain']);
        }
        
        $row = $this->doPrepareOutputImages($row);
        $row = $this->doPrepareClientImages($row);
        // _json($row);
        return $row;
    }
    
    /*
    無圖時有預設圖片
    */
    public function doPrepareOutputImages($row)
    {
        $row = $this->prepareOutputImage($row, 'image_logo', $this->tableName);
        $row = $this->prepareOutputImage($row, 'client_image_logo', $this->tableName);
        return $row;
    }
    
    /*
    無圖時沒有預設圖片
    */
    public function doPrepareClientImages($row)
    {
        $row = $this->prepareClientImage($row, 'image_logo', $this->tableName);
        $row = $this->prepareClientImage($row, 'client_image_logo', $this->tableName);
        return $row;
    }
}