<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\HtmlController;

class XXX extends HtmlController
{
    
    /*
    @test
    https://demo2.app/AdminHtml/Activities/index
    */
    public function index()
    {
        try{
           // if(\Auth::isUser() == false){ return; }
            $rdb = new \Rdb\Activities();
            $map = \RdbCondition\Web::init();
            $rows = $rdb->where($map)->order('sort asc, id desc')->select();
            $rows = $rdb->prepareRows($rows);
            // $rows = $rdb->debug();
            $this->vars['total'] = count($rows);
            $this->vars['datalist'] = $rows;
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/XXX/index
    */
    public function index()
    {
        try{
           // if(\Auth::isUser() == false){ return; }
            
            //-----
            $rdb = new \Rdb\Student();
            $rdb->where2WebId();
            $rdb->where2SchoolId();
            // $rdb->where2SelectStatus($this->params);
            // $rdb->where2SelectJob($this->params);
            // $rdb->where2SelectServe($this->params);
            // $rdb->where2SelectIsSigned($this->params);
            $rows = $rdb->where2()->order('sort asc')->select();
            $rows = $rdb->prepareRows($rows);
            // $rows = $rdb->select2();
            // $rows = $rdb->debug();
            $this->vars['total'] = count($rows);
            $this->vars['datalist'] = $rows;
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
    
}
