<?php
/*
\AdminApi\Posts\Remove
*/
namespace AdminApi\Posts;

class Remove extends \Api\Core\Remove
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Posts();
    }
    
}