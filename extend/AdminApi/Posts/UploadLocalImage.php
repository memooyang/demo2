<?php
/*
\AdminApi\Posts\UploadLocalImage
*/
namespace AdminApi\Posts;

class UploadLocalImage extends \Api\Core\UploadLocalImage
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Posts();
    }
    
}