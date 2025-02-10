<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class ActivityMaps extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/ActivityMaps/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '集章活動';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
    /*
    基本資料
    頂部區塊
    活動首頁
    集章活動說明
    集章活動地圖
    集章頁面
    兌換獎品
    兌換完成
    問券調查
    摸彩    
    @test
    https://demo2.app/AdminDashboard/ActivityMaps/Edit
    */
    public function Edit()
    {
        try{
            // if(!tata()){ _test('Please wait...'); } //DONE
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '管理活動地圖';
            $this->setBackUrl("/".$this->thisController."/index");
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('沒有對應ID'); }
            $rdb = new \Rdb\ActivityMaps();
            $map = \RdbCondition\Web::init();
            $map['id'] = $id;
            $row = $rdb->where($map)->find();
            $row = $rdb->prepare($row);
            $this->assigns['row'] = $row;
            // _json($row);
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
}
