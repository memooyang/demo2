<?php
/*
\AdminApi\AdminUsers\Remove
*/
namespace AdminApi\AdminUsers;

class Remove extends \Api\Core\Remove
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\AdminUsers();
    }
    
}