<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Posts extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Posts/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '文章';
            
            //-----
            $rdb = new \Rdb\PostCategory();
            $map = \RdbCondition\Web::init();
            $map['is_remove'] = '0';
            $map['status'] = '1';
            $rows = $rdb->where($map)->select();
            $rows = $rdb->prepareRows($rows);
            $this->vars['rowsCategory'] = $rows;
            
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Posts/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '編輯文章';
            $this->setBackUrl("/".$this->thisController."/index");
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('沒有對應ID'); }
            $rdb = new \Rdb\Posts();
            $map = \RdbCondition\Web::init();
            $map['id'] = $id;
            $row = $rdb->where($map)->find();
            $row = $rdb->prepare($row);
            $this->assigns['row'] = $row;
            
            //-----
            $rdb = new \Rdb\PostCategory();
            $map = \RdbCondition\Web::init();
            $map['is_remove'] = '0';
            $map['status'] = '1';
            $rows = $rdb->where($map)->select();
            $rows = $rdb->prepareRows($rows);
            $this->vars['rowsCategory'] = $rows;
            // _json($rows);
            
            // _json($row['role_ids']);
            // _test(_htmlToSelectedWithExplode('1', $row['role_ids']));
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
}
