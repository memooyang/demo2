<?php
declare (strict_types = 1);

namespace app\AdminHtml\common;

class BaseController extends \app\BaseAdminDashboardController
{
    protected function initialize()
    {
        parent::initialize();
        $this->initAdminByToken();
    }
    
}
