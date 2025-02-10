<?php
/*
\Rdb\BaseUser
*/
namespace Rdb;

use Rdb\Base;

abstract class BaseUser extends Base
{
    
    public static $role = array(
        '1' => ['slug'=>'user','name'=>'用戶'],
    );
    
    public function prepare($row)
    {
        if(empty($row)){ return false; }
        $row = parent::prepare($row);
        
        // $row['role'] = $row['role']??'';
        $row['name'] = $row['name']??'';
        // $row['tel'] = $row['tel']??'';
        // $row['mobile'] = $row['mobile']??'';
        $row['email'] = $row['email']??'';
        $row['avatar'] = $row['avatar']??'';
        // $row['amount_exp'] = $row['amount_exp']??'0';
        $row['__OUTPUT__'] = array();
        $row['__OUTPUT__']['name'] = $row['name']??$row['nickname'];
        // $row['__OUTPUT__']['name-1'] = mb_substr($row['name'],0,1);
        // $row['__OUTPUT__']['name-1'] = $row['__OUTPUT__']['name-1']??'';
        $row['__OUTPUT__']['role'] = self::outputRoleName($row['role_id']);
        // $row['__OUTPUT__']['amount_exp'] = number_format($row['amount_exp']);
        // $row['__OUTPUT__']['tel'] = ($row['tel']);
        // $row['__OUTPUT__']['mobile'] = ($row['mobile']);
        // $row['__OUTPUT__']['mobile-or-tel'] = ($row['tel'])?$row['tel']:$row['mobile'];
        // $row['__OUTPUT__']['mobile-or-tel'] = ($row['mobile'])?$row['mobile']:$row['tel'];
        
        // _json($row);
        return $row;
    }
    
    public function mapSelectStatus($params = array(), $map = array()){
        $data = $params['select-status']??'all';
        switch($data){
            default:
            case 'all':
                break;
            case 'valid':
                $map[] = ['is_remove', '=', '0'];
                $map[] = ['is_lock', '=', '0'];
                break;
            case 'lock':
                $map[] = ['is_lock', '=', '1'];
                break;
            case 'invalid':
                $map[] = ['is_remove', '=', '1'];
                break;
            case 'draft':
                $map[] = ['status', '=', 'draft'];
                break;
            case 'pending':
                $map[] = ['status', '=', 'pending'];
                break;
            case 'approve':
                $map[] = ['status', '=', 'approve'];
                break;
        }
        return $map;
    }
    
    // public function mapRole($params = array(), $map = array()){
    //     // if(\Auth::isInternalAccount()){
    //     // }else if(\Auth::isSu()){
    //     // }else if(\Auth::isAdmin()){
    //     // }else if(\Auth::isManager()){
    //     // }
    //     $role = $params['role']??'all';
    //     switch($role){
    //         default:
    //             break;
    //         case 'all':
    //             $map[] = ['role', '=', $role];
    //             $this->whereRaw("role='manager' OR role='admin' OR role='su'");
    //             break;
    //     }
    // }
    
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
}