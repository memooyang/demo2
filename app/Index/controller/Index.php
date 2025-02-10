<?php

namespace app\Index\controller;
use app\BaseIndexController;

class Index extends BaseIndexController
{
    /*
    @test
    http://localhost/
    http://localhost/Index/Index/index
    https://demo2.app/
    */
    public function index()
    {
        try{
            $web_id = \Web::id();
            
            //-----
            $rows = \Rdb\Slide::takeRowsForClientStage('goods');
            $rows = \Rdb\Slide::prepareRowsForGoods($rows);
            $this->vars['rowsGoods'] = $rows;
            
            //-----
            $rows = \Rdb\Slide::takeRowsForClientStage('activities');
            // _json($rows);
            $rows = \Rdb\Slide::prepareRowsForActivities($rows);
            $this->vars['rowsActivities'] = $rows;
            
            //-----
            $rows = \Rdb\Slide::takeRowsForClientStage('sponsors');
            $rows = \Rdb\Slide::prepareRowsForSponsors($rows);
            $this->vars['rowsSponsors'] = $rows;
            
            // //-----
            // $rdb = new \Rdb\Activities();
            // $map = [];
            // $map['web_id'] = $web_id;
            // $map['is_remove'] = '0';
            // // $map['is_top'] = '0';
            // // $map['is_recommend'] = '0';
            // $rows = $rdb->where($map)->order('sort asc, is_top desc, is_recommend desc, id desc')->select();
            // $rows = $rdb->prepareRows($rows);
            // $this->vars['rowsActivities'] = $rows;
            
            //-----
            $rdb = new \Rdb\WebTotal();
            $map = \RdbCondition\Web::init();
            $data = $rdb->where($map)->find();
            $data = $rdb->prepare($data);
            $this->vars['dataWebTotal'] = $data;
            
            // //-----
            // $rdb = new \Rdb\Sponsors();
            // $map = \RdbCondition\Web::init();
            // $map['is_remove'] = '0';
            // // $map['is_top'] = '0';
            // // $map['is_recommend'] = '1';
            // $rows = $rdb->where($map)->order('sort asc, id asc')->select();
            // $rows = $rdb->prepareRows($rows);
            // $this->vars['rowsSponsors'] = $rows;
            
            //-----
            $this->assignWebHomepage();
            return $this->render(__FUNCTION__);
        }catch(\Exception $e){
            _test($e);
        }
    }
}
