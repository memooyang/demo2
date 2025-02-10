<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Sponsors extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Sponsors/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '廠商';
            
            //-----
            $rdb = new \Rdb\SponsorCategory();
            $map = \RdbCondition\Web::init();
            $map['is_remove'] = '0';
            $map['status'] = '1';
            $rows = $rdb->where($map)->select();
            $rows = $rdb->prepareRows($rows);
            $this->vars['rowsCategory'] = $rows;
            
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Sponsors/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '編輯廠商';
            $this->setBackUrl("/".$this->thisController."/index");
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('沒有對應ID'); }
            $rdb = new \Rdb\Sponsors();
            $map = \RdbCondition\Web::init();
            $map['id'] = $id;
            $row = $rdb->where($map)->find();
            $row = $rdb->prepare($row);
            $this->assigns['row'] = $row;
            
            //-----
            $rdb = new \Rdb\SponsorCategory();
            $map = \RdbCondition\Web::init();
            $map['is_remove'] = '0';
            $map['status'] = '1';
            $rows = $rdb->where($map)->select();
            $rows = $rdb->prepareRows($rows);
            $this->vars['rowsCategory'] = $rows;
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
}
