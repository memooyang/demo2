<?php
/*
\Api\Core\UploadLocalImage
*/
namespace Api\Core;

class UploadLocalImage extends \Api\Upload
{
    public function doProcess()
    {
        if(empty($this->user)){ throw new \Exception('沒有上傳者資訊'); }
        
        //-----
        $params = $this->params;
        $dir_path = $this->params['dir_path']??'';
        $dir_path = ($dir_path)?$dir_path:\Upload\Config::$dir_paths['images'];
        $service = new \Upload\Local\Uploader();
        $service->init($params);
        $service->setUser($this->user);
        $service->setController($this->controller);
        $service->setDirPath($dir_path);
        $result = $service->doProcess();
        
        //-----
        $this->result = $this->doUpdate($result);
        return $this->result;
    }  
}