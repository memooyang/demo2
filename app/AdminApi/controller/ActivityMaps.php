<?php

namespace app\AdminApi\controller;
use app\AdminApi\common\BaseController;

class ActivityMaps extends BaseController
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminApi/ActivityMaps/Add
    */
    public function Add()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\ActivityMaps\Add();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/ActivityMaps/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\ActivityMaps\Edit();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/ActivityMaps/StatusEnable
    */
    public function StatusEnable()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\ActivityMaps\StatusEnable();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/ActivityMaps/Remove
    */
    public function Remove()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\ActivityMaps\Remove();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/ActivityMaps/Sort
    */
    public function Sort()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\ActivityMaps\Sort();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/ActivityMaps/EditSwitch
    */
    public function EditSwitch()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\ActivityMaps\EditSwitch();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    public function UploadImage()
    {
        try{
            $this->setAction(__FUNCTION__);
            
            //-----activity_id
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('NO ID'); }
            
            //-----
            $rdb = new \Rdb\ActivityMaps();
            $map = [];
            $map['id'] = $id;
            $row = $rdb->where($map)->find();
            if(empty($row)){ throw new \Exception('資料不存在'); }
            $row = $rdb->prepare($row);
            $activity_id = $row['activity_id'];
            
            //-----
            $dir_path = \Upload\Config::$dir_paths['activities'];
            $dir_path .= "/{$activity_id}";
            $this->params['dir_path'] = $dir_path;
            
            //-----
            $this->logBeforeUpload();
            // $service = new \AdminApi\ActivityMaps\UploadLocalImage();
            // $service = new \AdminApi\ActivityMaps\UploadCloudImage();
            $service = new \AdminApi\ActivityMaps\UploadImage();
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
