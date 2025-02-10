<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Me extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Me/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '帳戶管理';
            $user = \Web::admin();
            $rdb = new \Rdb\AdminUsers();
            $map = \RdbCondition\Web::init();
            $map['id'] = $user['id'];
            $row = $rdb->where($map)->find();
            $row = $rdb->prepare($row);
            $this->assigns['row'] = $row;
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
}
