<?php
/*
\Api\Base
*/
namespace Api;

abstract class Base
{
    //input
    public $params = [];
    
    //attribute
    public $rdb = null;
    public $controller = null;
    public $rdbs = [];
    public $vars = [];
    public $objs = [];
    public $instance = [];
    public $user = [];
    
    //output
    public $result = [];
    
    public function init($params = [])
    {
        $this->params = $params;
    }

    public function setUser($user = [])
    {
        $this->user = $user;
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