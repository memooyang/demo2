<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class ActivityPrizes extends BaseController
{
    /*
    @test
    https://demo2.app/AdminDashboard/ActivityPrizes/index
    */
    public function index()
    {
        try{
            $this->thisTitle = '摸彩獎品';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/ActivityPrizes/Edit
    */
    public function Edit()
    {
        try{
            $controller = __CLASS__;
            $this->thisTitle = '管理集章活動';
            $this->setBackUrl("/{$controller}/index");
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('沒有對應ID'); }
            $rdb = new \Rdb\ActivityPrizes();
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
