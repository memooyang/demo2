<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Media extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Media/index
    */
    public function index()
    {
        try{
            // if(!tata()){ _test('Please wait...'); } //DONE
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '媒體庫';
            
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Media/ImagePicker
    */
    public function ImagePicker()
    {
        try{
            // if(!tata()){ _test('Please wait...'); } //DONE
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '選擇圖庫';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Media/Edit
    */
    // public function Edit()
    // {
    //     try{
    //         $this->setAction(__FUNCTION__);
    //         $this->thisTitle = '媒體庫';
    //         $this->setBackUrl("/".$this->thisController."/index");
    //         $id = $this->params['id']??'';
    //         if(empty($id)){ throw new \Exception('沒有對應ID'); }
    //         $rdb = new \Rdb\Media();
    //         $map = \RdbCondition\Web::init();
    //         $map['id'] = $id;
    //         $row = $rdb->where($map)->find();
    //         $row = $rdb->prepare($row);
    //         $this->assigns['row'] = $row;
    //         return $this->render(__FUNCTION__);
    //     }catch(\Exception $e){
    //         $this->logException($e);
    //     }
    // }
    
}
