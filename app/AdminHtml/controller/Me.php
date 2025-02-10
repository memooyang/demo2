<?php

namespace app\AdminHtml\controller;
use app\AdminHtml\common\BaseController;

class Me extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    http://localhost/AdminHtml/Me/Avatar
    http://localhost:8000/AdminHtml/Me/Avatar
    @view
    */
    public function Avatar()
    {
        try{
            $this->setAction(__FUNCTION__);
            $rdb = new \Rdb\Avatar();
            $rdb->where2('is_remove', '0');
            $rdb->order('sort ASC');
            $rows = $rdb->select2();
            $this->vars['total'] = count($rows);
            $this->vars['datalist'] = $rows;
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
}
