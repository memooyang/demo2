<?php

namespace app\Teach\controller;
use app\Teach\common\BaseController;

class Page extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/Teach/Page/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
    /*
    @test
    https://demo2.app/Teach/Page/error404
    */
    public function error404()
    {
        try{
            $this->setAction(__FUNCTION__);
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
}
