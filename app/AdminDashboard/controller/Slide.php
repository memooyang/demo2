<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Slide extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Slide/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '幻燈片';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Slide/Goods
    */
    public function Goods()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '推薦禮品';
            $this->vars['ref_type'] = 'goods';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Slide/Activities
    */
    public function Activities()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '推薦活動';
            $this->vars['ref_type'] = 'activities';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Slide/Sponsors
    */
    public function Sponsors()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '優質廠商';
            $this->vars['ref_type'] = 'sponsors';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Slide/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '編輯資訊';
            
            //-----
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('沒有對應ID'); }
            $rdb = new \Rdb\Slide();
            $map = \RdbCondition\Web::init();
            $map['id'] = $id;
            $row = $rdb->where($map)->find();
            $row = $rdb->prepare($row);
            $this->assigns['row'] = $row;
            // _json($row);
            
            //-----
            // $this->setBackUrl("/".$this->thisController."/index");
            if($row['ref_type'] == 'goods'){
                $this->setBackUrl("/".$this->thisController."/Goods");
            }else if($row['ref_type'] == 'activities'){
                $this->setBackUrl("/".$this->thisController."/Activities");
            }else if($row['ref_type'] == 'sponsors'){
                $this->setBackUrl("/".$this->thisController."/Sponsors");
            }
            
            //-----
            $rows = $rdb->fetchRefRows($row);
            $this->vars['rowsRef'] = $rows;
            // _json($rows);
            
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
    
}
