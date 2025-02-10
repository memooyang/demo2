<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Terms extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Terms/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '使用條款';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
    
}
