<?php
/*
\AdminApi\AdminUsers\Lock
*/
namespace AdminApi\AdminUsers;

class Lock extends \Api\Core\Lock
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\AdminUsers();
    }
    
}