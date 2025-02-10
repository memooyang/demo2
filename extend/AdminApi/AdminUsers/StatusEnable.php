<?php
/*
\AdminApi\AdminUsers\StatusEnable
*/
namespace AdminApi\AdminUsers;

class StatusEnable extends \Api\Core\StatusEnable
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\AdminUsers();
    }
    
}