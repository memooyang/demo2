<?php

namespace app\AdminApi\controller;
use app\AdminApi\common\BaseController;

class PostCategory extends BaseController
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    http://localhost/AdminApi/PostCategory/Add
    */
    public function Add()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\PostCategory\Add();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/PostCategory/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\PostCategory\Edit();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/PostCategory/EditSwitch
    */
    public function EditSwitch()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\PostCategory\EditSwitch();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/PostCategory/Remove
    */
    public function Remove()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\PostCategory\Remove();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/PostCategory/Sort
    */
    public function Sort()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\PostCategory\Sort();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/PostCategory/StatusEnable
    */
    public function StatusEnable()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\PostCategory\StatusEnable();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
}
