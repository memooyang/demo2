<?php
/*
\Rdb\BaseUsers
*/
namespace Rdb;

use Rdb\Base;

abstract class BaseUsers extends Base
{
    
    // public static function outputRoleName($key){
    //     if(empty($key)){ return ''; }
    //     $text = self::$role[$key]['name']??'';
    //     return $text;
    // }
    
    public function prepare($row)
    {
        if(empty($row)){ return false; }
        $row = parent::prepare($row);
        
        $row['name'] = $row['name']??'';
        $row['email'] = $row['email']??'';
        $row['avatar'] = $row['avatar']??'';
        $row['__OUTPUT__'] = array();
        $row['__OUTPUT__']['name'] = $row['name']??'';
        
        // _json($row);
        return $row;
    }
    
    public function prepareOutputAvatar($row, $field_name = 'avatar')
    {
        //-----
        // $row['__OUTPUT__'][$field_name] = "images/avatars/man-1.png";
        $avatar = $row[$field_name]??\Image\Avatar::$default_image;
        $row['__OUTPUT__'][$field_name] = $avatar;
        // return $row;
        
        //-----
        // storage/uploads/avatar/uploads/avatar/677a76e922ed8.jpeg
        if(strpos($row[$field_name], 'https://') === false){ 
            $storage_dir = 'storage';
            $dir_path = 'uploads/avatar';
            $avatar = str_replace($storage_dir, '', $avatar);
            $avatar = str_replace($dir_path, '', $avatar);
            $avatar = str_replace('/', '', $avatar);
            $file = "{$storage_dir}/{$dir_path}/{$avatar}";
            // if($row['id'] != 455){ _j($file); }
            $valid = \Validator\File::check($file);
            if($valid == false){ $file = \Image\Avatar::$default_image; }
            $row['__OUTPUT__'][$field_name] = $file;
        }
        return $row;
    }
    
    public function prepareWithoutPassword($row)
    {
        $row = $this->prepare($row);
        unset($row['password']);
        
        return $row;
    }

    public function prepareRowsWithoutPassword($objs)
    {
        if(empty($objs)){ return array(); }
        if(is_object($objs)){
            $objs = $objs->toArray();
        }
        $rows = [];
        foreach($objs as &$obj){
            $id = $obj['id'];
            $rows[$id] = $obj;
        }
        foreach($rows as &$row){
            $row = $this->prepareWithoutPassword($row);
        }
        
        return $rows;
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
    
    public function where2SelectRoleId($params = array(), $where2 = array()){
        $data = $params['select-role_id']??'';
        if(empty($data)){ return $this; }
        $this->where2('role_id', $data);
        return $this;
    }
    
    public function where2SelectRoleIds($params = array(), $where2 = array()){
        $data = $params['select-role_id']??'';
        if(empty($data)){ return $this; }
        $this->whereFindInSet2('role_ids', $data);
        return $this;
    }
    
    public function where2SelectPermissionIds($params = array(), $where2 = array()){
        $data = $params['select-permission_id']??'';
        if(empty($data)){ return $this; }
        $this->whereFindInSet2('permission_ids', $data);
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