<?php

namespace app\AdminApi\controller;
use app\AdminApi\common\BaseController;

class Sponsors extends BaseController
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    http://localhost/AdminApi/Sponsors/Add
    http://localhost:8000/AdminApi/Sponsors/Add
    */
    public function Add()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Sponsors\Add();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/Sponsors/Edit
    http://localhost:8000/AdminApi/Sponsors/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Sponsors\Edit();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/Sponsors/EditSwitch
    http://localhost:8000/AdminApi/Sponsors/EditSwitch
    */
    public function EditSwitch()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Sponsors\EditSwitch();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/Sponsors/Remove
    http://localhost:8000/AdminApi/Sponsors/Remove
    */
    public function Remove()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Sponsors\Remove();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/Sponsors/Sort
    http://localhost:8000/AdminApi/Sponsors/Sort
    */
    public function Sort()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Sponsors\Sort();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Sponsors/StatusEnable
    */
    public function StatusEnable()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Sponsors\StatusEnable();
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
    https://demo2.app/AdminApi/Sponsors/UploadImage
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
            $dir_path = \Upload\Config::$dir_paths['sponsors'];
            $dir_path .= "/{$id}";
            $this->params['dir_path'] = $dir_path;
            
            //-----
            $this->logBeforeUpload();
            // $service = new \AdminApi\Sponsors\UploadLocalImage();
            // $service = new \AdminApi\Sponsors\UploadCloudImage();
            $service = new \AdminApi\Sponsors\UploadImage();
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
