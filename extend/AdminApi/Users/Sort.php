<?php
/*
\AdminApi\Users\Sort
*/
namespace AdminApi\Users;

class Sort extends \Api\Core\Sort
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Users();
    }
    
}