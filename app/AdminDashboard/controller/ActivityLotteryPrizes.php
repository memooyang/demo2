<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class ActivityLotteryPrizes extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/ActivityLotteryPrizes/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '摸彩獎品';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/ActivityLotteryPrizes/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '管理摸彩獎品';
            $this->setBackUrl("/".$this->thisController."/index");
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('沒有對應ID'); }
            $rdb = new \Rdb\ActivityLotteryPrizes();
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
