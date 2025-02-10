<?php
/*
\Rdb\BaseTouchRecord
*/
namespace Rdb;

use Rdb\Base;

abstract class BaseTouchRecord extends Base
{
    
    public function prepare($row)
    {
        if(empty($row)){ return false; }
        $row = parent::prepare($row);
        
        return $row;
    }
    
    public function touchRecord($map = [], $dataset = []){
        $web_id = \Web::id();
        if(empty($map)){
            $map = [];
            $map['web_id'] = $web_id;
        }
        if(empty($dataset)){
            $dataset = [];
            $dataset['web_id'] = $web_id;
        }
        $row = $this->where($map)->find();
        if(empty($row)){ 
            $aff = $this->add2($dataset);
            $row = $this->where('id', $aff)->find();
        }
        $row = $this->prepare($row);
        return $row;
    }
}