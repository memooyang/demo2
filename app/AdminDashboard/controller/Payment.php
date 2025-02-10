<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Payment extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Payment/Newebway
    */
    public function Newebway()
    {
        try{
            $this->thisTitle = '藍新金流';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Payment/Paypal
    */
    public function Paypal()
    {
        try{
            $this->thisTitle = 'Paypal金流';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
}
