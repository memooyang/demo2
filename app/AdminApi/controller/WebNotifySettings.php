<?php

namespace app\AdminApi\controller;
use app\AdminApi\common\BaseController;

class WebNotifySettings extends BaseController
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminApi/WebNotifySettings/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\WebNotifySettings\Edit();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
}
