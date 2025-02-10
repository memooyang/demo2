<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class PostCategory extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/PostCategory/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '文章分類';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/PostCategory/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '編輯文章分類';
            $this->setBackUrl("/".$this->thisController."/index");
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('沒有對應ID'); }
            $rdb = new \Rdb\PostCategory();
            $map = \RdbCondition\Web::init();
            $map['id'] = $id;
            $row = $rdb->where($map)->find();
            $row = $rdb->prepare($row);
            $this->assigns['row'] = $row;
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
    
}
