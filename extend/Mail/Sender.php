<?php
/*
\Mail\Sender
*/
namespace Mail;

class Sender
{
    public $params = [];
    public $instance = [];
    public $result = [];
    
    public function init($params){
    	$this->params = $params;
    }
    
    public function setInstance($instance){
    	$this->instance = $instance;
    }
}