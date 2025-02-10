<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Contact extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Contact/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '聯絡我們';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Contact/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '管理聯絡我們';
            $this->setBackUrl("/".$this->thisController."/index");
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('沒有對應ID'); }
            $rdb = new \Rdb\Contact();
            $map = \RdbCondition\Web::init();
            $map['id'] = $id;
            $row = $rdb->where($map)->find();
            $row = $rdb->prepare($row);
            $this->assigns['row'] = $row;
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
}
