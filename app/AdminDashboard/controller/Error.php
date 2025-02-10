<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Error extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Error/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            exit;
        }catch(\Exception $e){
        }
    }
    
    public function __call($method, $args)
    {
        return 'error request!';
    }
}
