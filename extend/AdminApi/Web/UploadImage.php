<?php
/*
\AdminApi\Web\UploadImage
*/
namespace AdminApi\Web;

class UploadImage extends \Api\Core\UploadImage
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Web();
    }
    
}