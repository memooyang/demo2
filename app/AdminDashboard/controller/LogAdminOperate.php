<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class LogAdminOperate extends BaseController
{
    /*
    @test
    https://demo2.app/AdminDashboard/LogAdminOperate/index
    */
    public function index()
    {
        try{
            $this->thisTitle = '操作記錄';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/LogAdminOperate/Edit
    */
    public function Edit()
    {
        try{
            $controller = __CLASS__;
            $this->thisTitle = '操作記錄資訊';
            $this->setBackUrl("/{$controller}/index");
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('沒有對應ID'); }
            $rdb = new \Rdb\LogAdminOperate();
            $map = \RdbCondition\Web::init();
            $map['id'] = $id;
            $row = $rdb->where($map)->find();
            $row = $rdb->prepare($row);
            $this->assigns['row'] = $row;
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
}
