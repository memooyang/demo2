<?php
/*
\Rdb\Base
*/
namespace Rdb;

abstract class Base extends Core
{
    public $instance = [];
    public $useFields = ['base'=>'id,created_at'];
    
    public function prepare($row)
    {
        if(empty($row)){ return false; }
        $row = parent::prepare($row);
        
        //-----
        $row['__OUTPUT__'] = [];
        // $row['dataFk'] = [];
        // $row['dataPk'] = [];
        return $row;
    }
    
    public function resetRowsByKey($rows = [], $key = 'id'){
        $arr = [];
        foreach($rows as &$row){
            $id = $row[$key];
            $arr[$id] = $row;
        }
        return $arr;
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
    
    public function rebuildWithField($rows = [], $field = 'fk_id')
    {
        $arr = [];
        foreach($rows as $row){
            $key = $row[$field];
            $arr[$key] = $row;
        }
        return $arr;
    }
    
    public function getOrderBy($params = array(), $where2 = array()){
        $data = $params['select-order_by']??'all';
        $str = '';
        switch($data){
            default:
            case 'all':
                break;
            case 'id-asc':
                $str = 'id asc';
                break;
            case 'id-desc':
                $str = 'id desc';
                break;
            case 'sort-asc,id-asc':
                $str = 'sort asc, id asc';
                break;
            case 'sort-asc,id-desc':
                $str = 'sort asc, id desc';
                break;
        }
        return $str;
    }
    
    public function preparePathToImage($row, $field_name = 'path', $to_name = 'image')
    {
        $img = $row[$field_name]??'';
        if(strpos($img, 'storage') !== false){ 
            $row['__PATH__'][$to_name] = $img;
        }else if(strpos($img, 'https://') === false){ 
            $file = "storage/{$img}";
            $valid = \Validator\File::check($file);
            if($valid == false){ $file = ''; }
            $row['__PATH__'][$to_name] = $file;
        }else if(strpos($img, 'https://') !== false){ 
            $row['__PATH__'][$to_name] = $img;
        }
        return $row;
    }
    
    public function prepareClientImage($row, $field_name = 'image', $dir_path = 'uploads/images')
    {
        $img = $row[$field_name]??'';
        if(strpos($img, 'storage') !== false){ 
            $row['__CLIENT_IMAGE__'][$field_name] = $img;
        }else if(strpos($img, 'https://') === false){ 
            $file = "storage/{$img}";
            $valid = \Validator\File::check($file);
            if($valid == false){ $file = ''; }
            $row['__CLIENT_IMAGE__'][$field_name] = $file;
        }else if(strpos($img, 'https://') !== false){ 
            $row['__CLIENT_IMAGE__'][$field_name] = $img;
        }
        return $row;
    }
    
    public function prepareOutputImage($row, $field_name = 'image', $dir_path = 'uploads/images')
    {
        $img = $row[$field_name]??'';
        if(strpos($img, 'storage') !== false){ 
            $row['__OUTPUT__'][$field_name] = $img;
        }else if(strpos($img, 'https://') === false){ 
            $file = "storage/{$img}";
            $valid = \Validator\File::check($file);
            if($valid == false){ $file = \Image\Clean::$photo; }
            $row['__OUTPUT__'][$field_name] = $file;
        }else if(strpos($img, 'https://') !== false){ 
            $row['__OUTPUT__'][$field_name] = $img;
        }
        return $row;
    }
    
    public function prepareRemoteImage($row, $field_name = 'avatar')
    {
        if(array_key_exists($field_name, $row) === false){ return $row; }
        if(strpos($row[$field_name], 'https://') !== false){ 
            $row['__OUTPUT__'][$field_name] = $row[$field_name];
        }
        return $row;
    }
    
    public function preparePrevIdAndNextId($row, $ids = [])
    {
        if(empty($row)){ return false; }
        $id_prev = '';
        $id_next = '';
        $row['__ID__']['prev'] = 0;
        $row['__ID__']['next'] = 0;
        $row['__ID__']['prev'] = $row['id']; //first
        foreach($ids as $pos => $id){
            if($id == $row['id']){
                if($id_prev){ //prev
                    $row['__ID__']['prev'] = $id_prev;
                }
                $id_next = ($id_next)?$id_next:$id; //last-1
                if(array_key_exists($pos+1, $ids)){
                    $id_next = $ids[$pos+1]; //last
                    // _json($id_next);
                }
                $row['__ID__']['next'] = $id_next;
            }
            $id_prev = $id;
        }
        // _json($row);
        return $row;
    }
    
    // public function where2FkIds($fk_ids = array(), $where2 = array()){
    //     $this->where2IsField('is_lock', $params, $where2);
    //     return $this;
    // }
    
    /*
    @Default
        $field = name
    @Or
        $field = name|title
    */
    public function _where2ForLikeCondition($field = 'name', $params_field = 'input-search_keyword', $params = array()){
        if(array_key_exists($params_field, $params) === false){ return $this; }
        $value = $params[$params_field]??'';
        if($value == ''){ return $this; }
        return $this->where2([
            [$field, 'like', "%{$value}%"]
            // ['status', '=', 1],
        ]);
    }
    
    public function where2InputSearchKeyword($field = 'name', $params = array(), $where2 = array()){
        return $this->_where2ForLikeCondition($field, 'input-search_keyword', $params);
    }
    
    public function where2IsLock($params = array(), $where2 = array()){
        $this->where2IsField('is_lock', $params, $where2);
        return $this;
    }
    
    public function where2IsNotLock($params = array(), $where2 = array()){
        $this->where2IsNotField('is_lock', $params, $where2);
        return $this;
    }
    
    public function where2IsRemove($params = array(), $where2 = array()){
        $this->where2IsField('is_remove', $params, $where2);
        return $this;
    }
    
    public function where2IsNotRemove($params = array(), $where2 = array()){
        $this->where2IsNotField('is_remove', $params, $where2);
        return $this;
    }
    
    public function where2IsField($field_name = '', $params = array(), $where2 = array()){
        $this->where2($field_name, '1');
        return $this;
    }
    
    public function where2IsNotField($field_name = '', $params = array(), $where2 = array()){
        $this->where2($field_name, '0');
        return $this;
    }
    
    public function where2SelectStatus($params = array(), $where2 = array()){
        $data = $params['select-status']??'all';
        switch($data){
            default:
            case 'all':
                break;
            case 'valid':
                $this->where2('is_remove', '0');
                $this->where2('status', '1');
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
    }
    
    public function where2SelectCategoryId($params = array(), $where2 = array()){
        $data = $params['select-category_id']??'';
        if($data != ''){
            $this->where2('category_id', $data);
        }
    }
    
    public function where2SelectIsRecommend($params = array(), $where2 = array()){
        $data = $params['select-is_recommend']??'';
        if($data != ''){
            $this->where2('is_recommend', $data);
        }
    }
    
    public function where2SelectRefType($params = array(), $where2 = array()){
        $data = $params['select-ref_type']??'';
        if($data != ''){
            $this->where2('ref_type', $data);
        }
    }
    
    /*
    @use
    increaseField();
    */
    public function increaseField($id = '', $field_name = '')
    {
        $map = [];
        $map['id'] = $id;
        $obj = $this->where($map)->find();
        $c = $obj[$field_name];
        $obj[$field_name] = $c + 1;
        $obj->save();
    }
}