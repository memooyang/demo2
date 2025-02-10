<?php
/*
\AdminApi\Web\Edit
*/
namespace AdminApi\Web;

class Remove extends \Api\Core\Remove
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Web();
    }
    
}