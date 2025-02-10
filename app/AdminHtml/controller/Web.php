<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\HtmlController;

class HtmlIndex extends HtmlController
{
    
    /*
    @test
    https://demo2.app/AdminDashboard/HtmlIndex/index
    */
    public function index()
    {
        try{
            $this->thisTitle = '總覽';
            $this->vars['hello'] = \Helper\Date\Hello::say();
            // _json($this->vars);
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
    
}
