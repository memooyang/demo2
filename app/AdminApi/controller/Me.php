<?php

namespace app\AdminApi\controller;
use app\AdminApi\common\BaseController;

class Me extends BaseController
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    http://localhost/AdminApi/Me/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Me\Edit();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/Me/EditPassword
    */
    public function EditPassword()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Me\EditPassword();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    http://localhost/AdminApi/Me/EditAvatar
    */
    public function EditAvatar()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Me\EditAvatar();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
}
