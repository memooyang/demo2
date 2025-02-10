<?php

namespace app\Index\controller;
use app\BaseController;

class Maintance extends BaseController
{
    /*
    @test
    http://localhost/
    http://localhost/Index/Maintance/index
    https://demo2.app/
    */
    public function index()
    {
        try{
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    http://localhost/
    http://localhost/Index/Maintance/ActivitiesNotPublish
    https://demo2.app/
    */
    public function ActivitiesNotPublish()
    {
        try{
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    http://localhost/
    http://localhost/Index/Maintance/ActivitiesFinishEvent
    https://demo2.app/
    */
    public function ActivitiesFinishEvent()
    {
        try{
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
        }
    }
}
