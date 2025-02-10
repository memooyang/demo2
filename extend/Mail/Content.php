<?php
/*
\Mail\Content
*/
namespace Mail;

class Content
{
    public $params = [];
    public $instance = [];
    public $result = [];
    
    public $subject = '';
    public $content = '';
    
    public function init($params){
    	$this->params = $params;
    }
    
    public function setInstance($instance){
    	$this->instance = $instance;
    }
}