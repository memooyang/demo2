<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Index extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->page['title'] = '';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Index/Logout
    */
    public function Logout()
    {
        \Session\Admin::_clear();
        $this->nav('index');
    }
    
}
