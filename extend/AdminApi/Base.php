<?php
/*
\AdminApi\Base
*/
namespace AdminApi;

abstract class Base
{
    public $controller = null;
    
    //input
    public $params = [];
    
    //attribute
    public $rdb = null;
    public $rdbs = [];
    public $vars = [];
    public $objs = [];
    public $instance = [];
    
    //output
    public $result = [];
    
    public function init($params = [])
    {
        $this->params = $params;
    }

    public function setInstance($instance = [])
    {
        $this->instance = $instance;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    // public function initAndCheckSalesman($id, $is_prepare = false)
    // {
    //     //-----
    //     $rdb = new \Rdb\Salesman();
    //     $map = [];
    //     $map['id'] = $id;
    //     $obj = $rdb->where($map)->find();
    //     if(empty($obj)){ throw new \Exception('用戶不存在'); }
    //     $this->objs['objSalesman'] = $obj;
    //     if($is_prepare){
    //         $obj = $obj->toArray();
    //         $obj = $rdb->prepare($obj);
    //     }
    //     return $obj;
    // }

}