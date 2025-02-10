<?php
/*
\AdminApi\Users\Remove
*/
namespace AdminApi\Users;

class Remove extends \Api\Core\Remove
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Users();
    }
    
}