<?php
/*
\AdminApi\Web\UploadLocalAvatar
*/
namespace AdminApi\Web;

class UploadLocalAvatar extends \Api\Core\UploadLocalAvatar
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Web();
    }
    
}