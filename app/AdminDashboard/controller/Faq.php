<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Faq extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Faq/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->page['title'] = '說明文件';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
}
