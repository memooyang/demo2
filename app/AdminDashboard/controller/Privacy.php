<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Privacy extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Privacy/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '隱私權政策';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
    
}
