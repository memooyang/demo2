<?php
/*
\Rdb\AdminUsers
*/
namespace Rdb;

use Rdb\BaseUser;

class Manager extends BaseUser
{
    //資料庫的資料表名稱 table name
    public $tableName = 'manager';
    
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
                if(\Auth::isInternalAccount()){
                    $this->whereRaw("role='manager' OR role='admin' OR role='su'");
                }else if(\Auth::isSu()){
                    $this->whereRaw("role='manager' OR role='admin' OR role='su'");
                }else if(\Auth::isAdmin()){
                    $this->whereRaw("role='manager' OR role='admin'");
                }else if(\Auth::isManager()){
                    $this->whereRaw("role='manager'");
                }
                break;
        }
        return $this;
    }
}