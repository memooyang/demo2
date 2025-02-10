<?php

namespace app\AdminApi\controller;
use app\AdminApi\common\BaseController;

class Dashboard extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Dashboard/Quicklink
    */
    public function Quicklink()
    { 
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Dashboard\Quicklink();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Dashboard/ActivitiesRecentNew
    */
    public function ActivitiesRecentNew()
    { 
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Dashboard\ActivitiesRecentNew();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Dashboard/UsersRecentNew
    */
    public function UsersRecentNew()
    { 
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Dashboard\UsersRecentNew();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Dashboard/OrdersRecentNew
    */
    public function OrdersRecentNew()
    { 
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Dashboard\OrdersRecentNew();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Dashboard/PostsRecentNew
    */
    public function PostsRecentNew()
    { 
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Dashboard\PostsRecentNew();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Dashboard/UsersRecentHot
    */
    public function UsersRecentHot()
    { 
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Dashboard\UsersRecentHot();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
}
