<?php
/*
\AdminApi\Users\UploadAvatar
*/
namespace AdminApi\Users;

class UploadAvatar extends \Api\Core\UploadAvatar
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Users();
    }
    
}