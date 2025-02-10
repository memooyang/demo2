<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Users extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Users/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '會員';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Users/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '會員資訊';
            $this->setBackUrl("/".$this->thisController."/index");
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('沒有對應ID'); }
            $rdb = new \Rdb\Users();
            $map = \RdbCondition\Web::init();
            $map['id'] = $id;
            $row = $rdb->where($map)->find();
            $row = $rdb->prepare($row);
            $this->assigns['row'] = $row;
            
            $rdb = new \Rdb\UserProfiles();
            $map = \RdbCondition\Web::init();
            $map['user_id'] = $id;
            // $row = $rdb->where($map)->find();
            $dataset = \RdbCondition\Web::init();
            $dataset['user_id'] = $id;
            $row = $rdb->touchRecord($map, $dataset);
            $row = $rdb->prepare($row);
            $this->assigns['dataUserProfiles'] = $row;
            // _json($row);
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
}
