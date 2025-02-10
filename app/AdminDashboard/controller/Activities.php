<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Activities extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Activities/index
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
    https://demo2.app/AdminDashboard/Activities/Edit
    */
    public function Edit()
    {
        try{
            // if(!tata()){ _test('Please wait...'); } //DONE
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '管理集章活動';
            $this->setBackUrl("/".$this->thisController."/index");
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('沒有對應ID'); }
            $rdb = new \Rdb\Activities();
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
    
    /*
    簡易QRCode
    @example
    https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=MQ%3D%3D
    @test
    https://demo2.app/Test/Qrcode/encode?text=01
    @test
        https://demo2.app/AdminDashboard/Activities/ActivityAreasQRCodes
    */
    public function ActivityAreasQRCodes()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '簡易活動QRCode';
            $this->setBackUrl("/".$this->thisController."/index");
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('沒有對應ID'); }
            
            //-----
            $rdb = new \Rdb\Activities();
            $map = \RdbCondition\Web::init();
            $map['id'] = $id;
            $row = $rdb->where($map)->find();
            if(empty($row)){ throw new \Exception('沒有活動資訊'); }
            $row = $rdb->prepare($row);
            // _json($row);
            
            //-----
            $rdb = new \Rdb\ActivityAreas();
            $map = \RdbCondition\Web::init();
            $map['activity_id'] = $id;
            $rows = $rdb->where($map)
            // ->whereJsonContains('numbers', $number)
            ->order('sort asc, id desc')
            ->select();
            // $rdb->debug();
            // _json($rows);
            $rows = $rdb->prepareRows($rows);
            
            $this->assigns['rows'] = $rows;
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
    /*
    online_url
    簡易QRCode
    @test
        https://demo2.app/AdminDashboard/Activities/ActivityAreasQRCodes
    @test
        https://demo2.app/AdminDashboard/Activities/ActivityAreasQRCodesOnlineUrl
    */
    public function ActivityAreasQRCodesOnlineUrl()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '網址活動QRCode';
            $this->setBackUrl("/".$this->thisController."/index");
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('沒有對應ID'); }
            
            //-----
            $rdb = new \Rdb\Activities(); 
            $map = \RdbCondition\Web::init();
            $map['id'] = $id;
            $row = $rdb->where($map)->find();
            if(empty($row)){ throw new \Exception('沒有活動資訊'); }
            $row = $rdb->prepare($row);
            // _json($row);
            
            //-----
            $rdb = new \Rdb\ActivityAreas();
            $map = \RdbCondition\Web::init();
            $map['activity_id'] = $id;
            $rows = $rdb->where($map)
            // ->whereJsonContains('numbers', $number)
            ->order('sort asc, id desc')
            ->select();
            // $rdb->debug();
            // _json($rows);
            $rows = $rdb->prepareRows($rows);
            
            $this->assigns['rows'] = $rows;
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
}
