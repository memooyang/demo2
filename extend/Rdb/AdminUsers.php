<?php
/*
\Rdb\AdminUsers
*/
namespace Rdb;

use Rdb\BaseUsers;

class AdminUsers extends BaseUsers
{
    public $tableName = 'admin_users';
    
    public static $permissions = array(
        '1' => ['slug'=>'*','name'=>'All'],
    );
    
    public static $roles = array(
        '1' => ['slug'=>'administrator','name'=>'系統管理員'],
        '2' => ['slug'=>'webmaster','name'=>'網站管理員'],
        '3' => ['slug'=>'editor','name'=>'內容管理員'],
        '4' => ['slug'=>'author','name'=>'作者'],
    );
    
    public function prepare($row)
    {
        if(empty($row)){ return false; }
        $row = parent::prepare($row);
        
        $row['__OUTPUT__']['name'] = ($row['name']);
        $row['__OUTPUT__']['name-1'] = mb_substr($row['name'],0,1);
        $row['__OUTPUT__']['name-1'] = $row['__OUTPUT__']['name-1']??'';
        $row['__OUTPUT__']['avatar'] = ($row['avatar']);
        $row = $this->prepareRemoteImage($row, 'avatar');
        $row['__OUTPUT__']['role'] = '';
        $row['__OUTPUT__']['role-slug'] = '';
        if($row['role_id']){ 
            $row['__OUTPUT__']['role'] = self::outputRoleName($row['role_id']);
            $row['__OUTPUT__']['role-slug'] = self::outputRoleSlug($row['role_id']);
        }
        if(!empty($row['permission_ids'])){ 
            $ids = explode(',', $row['permission_ids']);
            $slugs = [];
            $names = [];
            foreach($ids as $id){
                $data = self::$permissions[$id];
                $slugs[$id] = $data['slug'];
                $names[$id] = $data['name'];
            }
            $row['__PERMISSION__']['slugs'] = $slugs;
            $row['__PERMISSION__']['names'] = $names;
        }
        // _json($row);
        return $row;
    }
    
    public static function outputPermissionSlug($key){
        if(empty($key)){ return ''; }
        if(array_key_exists($key, self::$permissions) == false){ return ''; }
        $text = self::$permissions[$key]['slug']??'';
        return $text;
    }
    
    public static function outputPermissionName($key){
        if(empty($key)){ return ''; }
        if(array_key_exists($key, self::$permissions) == false){ return ''; }
        $text = self::$permissions[$key]['name']??'';
        return $text;
    }
    
    public static function outputRoleSlug($key){
        if(empty($key)){ return ''; }
        if(array_key_exists($key, self::$roles) == false){ return ''; }
        $text = self::$roles[$key]['slug']??'';
        return $text;
    }
    
    public static function outputRoleName($key){
        if(empty($key)){ return ''; }
        if(array_key_exists($key, self::$roles) == false){ return ''; }
        $text = self::$roles[$key]['name']??'';
        return $text;
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
                $this->where2('status', '1');
                break;
            case 'lock':
                $this->where2('is_lock', '1');
                break;
            case 'remove':
                $this->where2('is_remove', '1');
                break;
            case 'status0':
                $this->where2('status', '0');
                break;
            case 'status1':
                $this->where2('is_remove', '0');
                $this->where2('status', '1');
                break;
        }
        return $this;
    }
}