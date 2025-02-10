<?php
/*
\AdminApi\Posts\UploadImage
*/
namespace AdminApi\Posts;

class UploadImage extends \Api\Core\UploadImage
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Posts();
    }
    
}