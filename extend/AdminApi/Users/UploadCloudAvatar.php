<?php
/*
\AdminApi\Users\UploadCloudAvatar
*/
namespace AdminApi\Users;

class UploadCloudAvatar extends \Api\Core\UploadCloudAvatar
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Users();
    }
    
}