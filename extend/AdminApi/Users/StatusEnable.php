<?php
/*
\AdminApi\Users\StatusEnable
*/
namespace AdminApi\Users;

class StatusEnable extends \Api\Core\StatusEnable
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Users();
    }
    
}