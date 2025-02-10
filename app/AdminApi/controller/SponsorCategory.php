<?php

namespace app\AdminApi\controller;
use app\AdminApi\common\BaseController;

class SponsorCategory extends BaseController
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    http://localhost/AdminApi/SponsorCategory/Add
    http://localhost:8000/AdminApi/SponsorCategory/Add
    */
    public function Add()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\SponsorCategory\Add();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/SponsorCategory/Edit
    http://localhost:8000/AdminApi/SponsorCategory/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\SponsorCategory\Edit();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/SponsorCategory/EditSwitch
    http://localhost:8000/AdminApi/SponsorCategory/EditSwitch
    */
    public function EditSwitch()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\SponsorCategory\EditSwitch();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/SponsorCategory/Remove
    http://localhost:8000/AdminApi/SponsorCategory/Remove
    */
    public function Remove()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\SponsorCategory\Remove();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/SponsorCategory/Sort
    http://localhost:8000/AdminApi/SponsorCategory/Sort
    */
    public function Sort()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\SponsorCategory\Sort();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/SponsorCategory/StatusEnable
    */
    public function StatusEnable()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\SponsorCategory\StatusEnable();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
}
