<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Web extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
        $this->assignSettings();
    }
    
    public function assignSettings()
    {
        $id = \Web::id();
        if(empty($id)){ throw new \Exception('沒有對應ID'); }
        $rdb = new \Rdb\Web();
        $map = [];
        $map['id'] = $id;
        $row = $rdb->where($map)->find();
        if(empty($row)){ throw new \Exception('沒有對應資料'); }
        $row = $rdb->prepare($row);
        $this->assigns['row'] = $row;
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Web/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '網站設定';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Web/Client
    */
    public function Client()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '資訊設定';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
}
