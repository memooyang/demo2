<?php
/*
\AdminApi\AdminUsers\Sort
*/
namespace AdminApi\AdminUsers;

class Sort extends \Api\Core\Sort
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\AdminUsers();
    }
    
}