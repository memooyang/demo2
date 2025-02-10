<?php
/*
\AdminApi\Web\Sort
*/
namespace AdminApi\Web;

class Sort extends \Api\Core\Sort
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Web();
    }
    
}