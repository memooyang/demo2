<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class WebHomepage extends BaseController
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
        $dataWeb = $rdb->prepare($row);
        $this->assigns['dataWeb'] = $dataWeb;
        
        //-----
        $map = [];
        $map['web_id'] = $id;
        $dataset = [];
        $dataset['web_id'] = $id;
        
        $rdb = new \Rdb\WebHomepage();
        $row = $rdb->touch($map, $dataset);
        $row = $rdb->prepare($row);
        // _json($row);
        $this->assigns['row'] = $row;
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/WebHomepage/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '頁面資訊';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/WebHomepage/Goods
    */
    public function Goods()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '禮品相關';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/WebHomepage/Steps
    */
    public function Steps()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '集點樂使用2步驟！';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/WebHomepage/HowToCollect
    */
    public function HowToCollect()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '金幣說明';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/WebHomepage/HowToExchange
    */
    public function HowToExchange()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '如何兌換';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/WebHomepage/About
    */
    public function About()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '認識集點樂';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/WebHomepage/Partnerships
    */
    public function Partnerships()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '異業合作';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/WebHomepage/Privacy
    */
    public function Privacy()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '隱私權與安全政策';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/WebHomepage/Terms
    */
    public function Terms()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '會員服務條款';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
    
}
