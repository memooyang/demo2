<?php
/*
\AdminApi\Posts\UploadCloudImage
*/
namespace AdminApi\Posts;

class UploadCloudImage extends \Api\Core\UploadCloudImage
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Posts();
    }
    
}