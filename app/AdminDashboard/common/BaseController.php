<?php
declare (strict_types = 1);

namespace app\AdminDashboard\common;

class BaseController extends \app\BaseAdminDashboardController
{
    protected function initialize()
    {
        parent::initialize();
        $user = \Web::admin();
        if(empty($user)){ $this->nav('/AdminStage'); }
        // _json($user);
    }
}
