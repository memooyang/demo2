<?php
/*
\AdminApi\Users\UploadLocalAvatar
*/
namespace AdminApi\Users;

class UploadLocalAvatar extends \Api\Core\UploadLocalAvatar
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Users();
    }
    
}