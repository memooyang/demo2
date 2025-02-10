<?php

namespace app\AdminApi\controller;
use app\AdminApi\common\BaseController;

class ActivityAreas extends BaseController
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminApi/ActivityAreas/Add
    */
    public function Add()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\ActivityAreas\Add();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/ActivityAreas/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\ActivityAreas\Edit();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/ActivityAreas/StatusEnable
    */
    public function StatusEnable()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\ActivityAreas\StatusEnable();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/ActivityAreas/Remove
    */
    public function Remove()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\ActivityAreas\Remove();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/ActivityAreas/Sort
    */
    public function Sort()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\ActivityAreas\Sort();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/ActivityAreas/EditSwitch
    */
    public function EditSwitch()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\ActivityAreas\EditSwitch();
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
            
            //-----
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('NO ID'); }
            
            //-----
            $rdb = new \Rdb\ActivityAreas();
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
            // $service = new \AdminApi\ActivityAreas\UploadLocalImage();
            // $service = new \AdminApi\ActivityAreas\UploadCloudImage();
            $service = new \AdminApi\ActivityAreas\UploadImage();
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
