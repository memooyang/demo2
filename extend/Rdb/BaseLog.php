<?php
/*
\Rdb\BaseLog
*/
namespace Rdb;

use Rdb\Base;

abstract class BaseLog extends Base
{
    
    public function prepare($row)
    {
        if(empty($row)){ return false; }
        $row = parent::prepare($row);
        
        return $row;
    }
    
    public function addLog($params = array()){
        if(array_key_exists('result', $params)){
            $params['body'] = $params['body']??[];
            $web_id = \Web::id();
            $user = \Web::user();
            $dataset = [];
            $dataset['web_id'] = $web_id;
            if($user){ $dataset['user_id'] = $user['id']; }
            $dataset['body'] = json_encode($params['body']);
            return $this->add2($dataset);
        }
    }
    
    public function updateResult($log_id, $params = array()){
        if(array_key_exists('result', $params) && $log_id){
            $params['result'] = $params['result']??[];
            $web_id = \Web::id();
            $user = \Web::user();
            $map = [];
            $map['id'] = $log_id;
            $dataset = [];
            if($user){ $dataset['user_id'] = $user['id']; }
            $dataset['result'] = json_encode($params['result']);
            return $this->where($map)->save($dataset);
        }
    }
    
}