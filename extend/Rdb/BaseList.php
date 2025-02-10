<?php
/*
\Rdb\BaseUser
*/
namespace Rdb;

use Rdb\Base;

abstract class BaseList extends Base
{
    
    public function prepare($row)
    {
        if(empty($row)){ return false; }
        $row = parent::prepare($row);
        
        $row['__OUTPUT_TW_DATE__']['date_year'] = bcsub($row['date_year'], 1911, 0);
        
        return $row;
    }
    
}