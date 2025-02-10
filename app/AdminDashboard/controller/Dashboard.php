<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Dashboard extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Dashboard/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '總覽';
            $this->vars['hello'] = \Helper\Date\Hello::say();
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
}
