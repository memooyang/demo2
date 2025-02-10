<?php
/*
\Export\Base
*/
namespace Export;

class Base
{
    //input
    public $params = array();
    public $__params = array();
    
    //attribute
    public $vars = array();
    public $datalist = array();
    public $instance = array();
    
    //output
    public $result = array();
    
    //file
    public $file_name = '';
    public $fp = null;
    public $url = '';
    public $file = '';
    public $dir_path = '/files/';
    public $file_ext = 'csv';
    
    public function init($params = array())
    {
        //-----
        $this->params = $params;
        $user = \Web::user();
        $web_id = $user['web_id'];
        
        //-----
        $dir_path = $this->dir_path;
        
        // //-----
        // $exec0 = "sudo chmod 777 -R ./Public/files/*";
        // $aff = exec($exec0);
        
        //-----
        setlocale(LC_ALL, 'zh_TW.BIG5');
        ini_set("memory_limit", "1024M");
        ob_clean();

        //-----
        $time = date('YmdHis');
        $file_name = $params['file_name']??'';
        if(empty($file_name)){
            $file_name = $this->file_name;
        }
        if(empty($file_name)){
            $file_name = uniqid();
        }
        $file_name = "{$file_name}_{$user['web_id']}_{$time}";

        //-----
        $dir = $dir_path;
        $path =  _REAL_PATH . "{$dir}";
        if (!file_exists($path)) {
            mkdir($path, 0777, true); //创建目录
        }

        //-----
        $dir_csv = "{$dir_path}csv/";
        $path =  _REAL_PATH . "{$dir}";
        if (!file_exists($path)) {
            mkdir($path, 0777, true); //创建目录
        }
        
        //-----
        if(empty($web_id)){
            $dir = $dir_csv;
        }else{
            $dir = "{$dir_csv}{$web_id}/";
        }
        
        //-----
        $path =  _REAL_PATH . "{$dir}";
        if (!file_exists($path)) {
            mkdir($path, 0777, true); //创建目录
        }
        
        //-----
        $file_ext =  $this->file_ext;
        $file_fullname =  "{$file_name}.{$file_ext}";
        $file =  "{$path}{$file_fullname}";
        $url =  "{$dir}{$file_fullname}";
        
        $this->file = $file;
        $this->url = $url;
        $this->fp = @fopen($file, "w");
    }
    
    public function initDatalist()
    {
    }
    
    public function buildFile($datalist = array())
    {
    }
    
    public function doProcess()
    {
        $this->initDatalist();
        $this->buildFile($this->datalist);
        \Helper\Download\Csv::process($this->url);
        exit;
    }
}