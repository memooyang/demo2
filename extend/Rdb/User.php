<?php
/*
NOUSE
\Rdb\User
*/
namespace Rdb;

use Rdb\BaseUser;

class User extends BaseUser
{
    public $tableName = 'user';
    
    public function prepare($row)
    {
        if(empty($row)){ return false; }
        $row = parent::prepare($row);
        
        //-----
        $row['__VALID__']['user_plan_expired'] = false;
        $row['__VALID__']['user_plan_expired'] = \Helper\Date\Validator::GT($row['user_plan_expired_at'], '', 'Ymd');
        
        //-----
        // $row = $this->prepareRemoteImage($row, 'avatar');
        $row = $this->doPrepareOutputImages($row);
        $row = $this->doPrepareClientImages($row);
        // _json($row);
        return $row;
    }
    
    /*
    無圖時有預設圖片
    */
    public function doPrepareOutputImages($row)
    {
        $row = $this->prepareOutputImage($row, 'avatar', 'uploads/avatar');
        return $row;
    }
    
    /*
    無圖時沒有預設圖片
    */
    public function doPrepareClientImages($row)
    {
        $row = $this->prepareClientImage($row, 'avatar', 'uploads/avatar');
        return $row;
    }
    
    public function where2SelectStatus($params = array(), $where2 = array()){
        $data = $params['select-status']??'all';
        switch($data){
            default:
            case 'all':
                break;
            case 'valid':
                $this->where2('is_remove', '0');
                $this->where2('is_lock', '0');
                break;
            case 'lock':
                $this->where2('is_lock', '1');
                break;
            case 'invalid':
                $this->where2('is_remove', '1');
                break;
            case 'draft':
                $this->where2('status', 'draft');
                break;
            case 'pending':
                $this->where2('status', 'pending');
                break;
            case 'approve':
                $this->where2('status', 'approve');
                break;
        }
        return $this;
    }
    
    public function where2SelectRole($params = array(), $where2 = array()){
        $data = $params['select-role']??'all';
        switch($data){
            default:
                $this->where2('role', $data);
                break;
            case 'all':
                if(0){
                }else if(\Auth::isUser()){
                    $this->whereRaw("role='user'");
                }
                break;
        }
        return $this;
    }
}