<?php
namespace RdbHandler;

class Base
{
    //input
    public $params = [];
    
    //attribute
    public $vars = [];
    public $instance = [];
    
    //output
    public $result = [];
    
    public function init($params = [])
    {
        $this->params = $params;
    }

}