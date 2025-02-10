<?php
/*
\AdminApi\Posts\StatusEnable
*/
namespace AdminApi\Posts;

class StatusEnable extends \Api\Core\StatusEnable
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Posts();
    }
    
}