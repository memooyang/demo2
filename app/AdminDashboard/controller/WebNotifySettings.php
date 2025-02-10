<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class WebNotifySettings extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
        $this->assignSettings();
    }
    
    public function assignSettings()
    {
        $id = \Web::id();
        if(empty($id)){ throw new \Exception('沒有對應ID'); }
        $rdb = new \Rdb\Web();
        $map = [];
        $map['id'] = $id;
        $row = $rdb->where($map)->find();
        if(empty($row)){ throw new \Exception('沒有對應資料'); }
        $dataWeb = $rdb->prepare($row);
        $this->assigns['dataWeb'] = $dataWeb;
        
        //-----
        $map = [];
        $map['web_id'] = $id;
        $map['mode'] = $dataWeb['mode'];
        $map['domain'] = $dataWeb['domain'];
        $dataset = [];
        $dataset['web_id'] = $id;
        $dataset['mode'] = $dataWeb['mode'];
        $dataset['domain'] = $dataWeb['domain'];
        
        $rdb = new \Rdb\WebNotifySettings();
        $row = $rdb->touch($map, $dataset);
        $row = $rdb->prepare($row);
        $this->assigns['row'] = $row;
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/WebNotifySettings/index
    */
    public function index()
    {
        try{
            $this->setAction(__FUNCTION__);
            $this->thisTitle = '通知設定';
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            // _test($e);
        }
    }
    
}
