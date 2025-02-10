<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class System extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    
    /*
    @test
    https://demo2.app/AdminDashboard/System/Environment
    */
    public function Environment()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '系統環境';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
}
