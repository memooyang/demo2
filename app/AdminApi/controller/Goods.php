<?php

namespace app\AdminApi\controller;
use app\AdminApi\common\BaseController;

class Goods extends BaseController
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    http://localhost/AdminApi/Goods/Add
    */
    public function Add()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Goods\Add();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/Goods/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Goods\Edit();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/Goods/EditSwitch
    */
    public function EditSwitch()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Goods\EditSwitch();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/Goods/Remove
    */
    public function Remove()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Goods\Remove();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/Goods/Sort
    */
    public function Sort()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Goods\Sort();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Goods/StatusEnable
    */
    public function StatusEnable()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Goods\StatusEnable();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    https://pqina.nl/slim/#jquery-api
    @test
    https://demo2.app/AdminApi/Goods/UploadImage
    @file
    {
        "status":"success",
        "name":"uid_filename.jpg",
        "path":"path/uid_filename.jpg"
    }
    */
    public function UploadImage()
    {
        try{
            $this->setAction(__FUNCTION__);
            
            //-----
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('NO ID'); }
            $dir_path = \Upload\Config::$dir_paths['goods'];
            $dir_path .= "/{$id}";
            $this->params['dir_path'] = $dir_path;
            
            //-----
            $this->logBeforeUpload();
            // $service = new \AdminApi\Goods\UploadLocalImage();
            // $service = new \AdminApi\Goods\UploadCloudImage();
            $service = new \AdminApi\Goods\UploadImage();
            $service->init($this->params);
            $service->setUser($this->user);
            $service->setController($this);
            $response = $service->doProcess();
            $this->logAfterUpload($response);
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
}
