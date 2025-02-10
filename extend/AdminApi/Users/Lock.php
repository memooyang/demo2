<?php
/*
\AdminApi\Users\Lock
*/
namespace AdminApi\Users;

class Lock extends \Api\Core\Lock
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Users();
    }
    
}