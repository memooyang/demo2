<?php
/*
\Rdb\BaseHistory
*/
namespace Rdb;

use Rdb\Base;

abstract class BaseHistory extends Base
{
    
    public function prepare($row)
    {
        if(empty($row)){ return false; }
        $row = parent::prepare($row);
        
        return $row;
    }
    
    public function touchHistory($data){
        // _test($data);
        $data['fk_id'] = $data['id'];
        unset($data['id']);
        return $this->save($data);
    }
    
    // public function add2($dataset = array()){
    //     $dataset['fk_id'] = $dataset['id'];
    //     unset($dataset['id']);
    //     return $this->add2($dataset);
    // }
    
    // public function save2($data = [], $sequence = null){
    //     $data['fk_id'] = $data['id'];
    //     // unset($data['id']);
    //     return $this->save2($data);
    // }
}