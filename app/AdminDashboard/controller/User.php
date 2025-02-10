<?php

namespace app\Teach\controller;
use app\Teach\common\BaseController;

class User extends BaseController
{
    /*
    @test
    https://demo2.app/Teach/User/index
    */
    public function index()
    {
        return $this->render(__FUNCTION__);
    }
}
