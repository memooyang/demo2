<?php

namespace app\AdminApi\controller;
use app\AdminApi\common\BaseController;

class Media extends BaseController
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Media/Add
    */
    public function Add()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Media\Add();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Media/AddDir
    */
    public function AddDir()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Media\AddDir();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Media/AddTopDir
    */
    public function AddTopDir()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Media\AddTopDir();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Media/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Media\Edit();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Media/StatusEnable
    */
    public function StatusEnable()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Media\StatusEnable();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Media/Star
    */
    public function Star()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Media\Star();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Media/Remove
    */
    public function Remove()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Media\Remove();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Media/Sort
    */
    public function Sort()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Media\Sort();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Media/ImagePicker
    */
    public function ImagePicker()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Media\ImagePicker();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Media/EditSwitch
    */
    public function EditSwitch()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Media\EditSwitch();
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
    https://demo2.app/AdminApi/Users/UploadFile
    @file
    {
        "status":"success",
        "name":"uid_filename.jpg",
        "path":"path/uid_filename.jpg"
    }
    */
    public function UploadToMedia()
    {
        try{
            $this->setAction(__FUNCTION__);
            
            //-----
            $dir_path = \Upload\Config::$dir_paths['media'];
            $this->params['dir_path'] = $dir_path;
            
            //-----
            $this->logBeforeUpload();
            $service = new \AdminApi\Media\UploadToMedia();
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
    
    /*
    https://pqina.nl/slim/#jquery-api
    @test
    https://demo2.app/AdminApi/Users/UploadImage
    @file
    {
        "status":"success",
        "name":"uid_filename.jpg",
        "path":"path/uid_filename.jpg"
    }
    */
    // public function UploadImages()
    // {
    //     try{
    //         //-----log
    //         $this->logBeforeUpload();
            
    //         //-----
    //         $id = $this->params['id']??'';
    //         if(empty($id)){ throw new \Exception('NO ID'); }
            
    //         //-----
    //         $dir_path = \Upload\Config::$dir_paths['media'];
    //         $dir_path .= "/{$id}";
    //         $this->params['dir_path'] = $dir_path;
            
    //         //-----local
    //         $service = new \AdminApi\Media\UploadLocalImage();
    //         $service->init($this->params);
    //         $service->setUser($this->user);
    //         $response = $service->doProcess();
    //         $this->apiSuccess($response);
    //     }catch(\Exception $e){
    //         $this->apiError($e);
    //     }
    // }
}
