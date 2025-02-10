<?php

namespace app\AdminApi\controller;
use app\AdminApi\common\BaseController;

class AdBanners extends BaseController
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    http://localhost/AdminApi/AdBanners/Add
    */
    public function Add()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\AdBanners\Add();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/AdBanners/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\AdBanners\Edit();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/AdBanners/EditSwitch
    */
    public function EditSwitch()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\AdBanners\EditSwitch();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/AdBanners/Remove
    */
    public function Remove()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\AdBanners\Remove();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/AdBanners/Sort
    */
    public function Sort()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\AdBanners\Sort();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/AdBanners/StatusEnable
    */
    public function StatusEnable()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\AdBanners\StatusEnable();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
}
