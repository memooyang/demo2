<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Order extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Order/Index
    */
    public function Index()
    {
        try{
            $this->thisTitle = '訂單';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Order/Edit
    */
    public function Edit()
    {
        try{
            $this->thisTitle = '訂單資訊';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
}
