<?php
/*
\AdminStage\Base
*/
namespace AdminStage;

abstract class Base
{
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

}