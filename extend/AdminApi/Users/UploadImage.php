<?php
/*
\AdminApi\Users\UploadImage
*/
namespace AdminApi\Users;

class UploadImage extends \Api\Core\UploadImage
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Users();
    }
    
}