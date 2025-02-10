<?php
/*
\Mail\Content\Builder
*/
namespace Mail\Content;

class Builder
{
    public $params = [];
    public $instance = [];
    public $result = [];
    
    public $subject = '';
    public $content = '';
    
    public function init($params){
    	$this->params = $params;
        //-----
        $this->subject = $this->params['subject']??'';
        $this->content = $this->params['content']??'';
    }
    
    public function setInstance($instance){
    	$this->instance = $instance;
    }
}