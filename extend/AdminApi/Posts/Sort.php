<?php
/*
\AdminApi\Posts\Sort
*/
namespace AdminApi\Posts;

class Sort extends \Api\Core\Sort
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Posts();
    }
    
}