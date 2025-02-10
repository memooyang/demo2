<?php

namespace app\AdminHtml\controller;
use app\AdminHtml\common\BaseController;

class Posts extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminHtml/Posts/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
           // if(\Auth::isUser() == false){ return; }
            //-----
            $this->params['page'] = $this->params['page']??1;
            $this->params['page_size'] = $this->params['page_size']??5;
            $page = $this->params['page'];
            $page_size = $this->params['page_size'];
            
            //-----
            $rdb = new \Rdb\Posts();
            $rdb->where2WebId();
            $rdb->where2SelectStatus($this->params);
            $rdb->where2SelectCategoryId($this->params);
            $rdb->where2InputSearchKeyword('title|title_sub', $this->params);
            $total = $rdb
            ->where2('is_remove',0)
            ->where2()
            ->count();
            // $rdb->debug();
            $rows = $rdb->where2()
            ->order('sort asc, id desc')
            ->page($page, $page_size)
            ->select();
            $rows = $rdb->prepareRows($rows);
            $this->vars['total'] = $total;
            $this->vars['datalist'] = $rows;
            $this->vars['paging'] = \Helper\Paging\Handler::make($total, $page_size, $page, '', $this->params);
            // _json($this->vars);
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
}
