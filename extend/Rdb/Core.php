<?php
/*
\Rdb\Base
*/
namespace Rdb;

use think\Model;

abstract class Core extends Model
{
    // 模型数据不区分大小写
    protected $strict = true;
    
    //資料庫的資料表名稱 table name
    public $tableName = '';
    
    //資料表主鍵 table pk field
    protected $pk = 'id';
    
    //資料表主鍵 table pk field
    public $_w = null;
    public $_w2 = null;
    
    public function debug()
    {
        $sql = $this->getLastSql();
        _test($sql);
    }
    
    public function prepare($row)
    {
        //-----物件轉換成陣列資料
        if(empty($row)){ return false; }
        if(is_object($row)){
            $row = $row->toArray();
        }
        
        //!!!!!!!!!!!-----fix-null-exception
        foreach($row as $k => $v){
            $row[$k] = (is_null($v))?'':$v;
        }
        
        //-----
        $table = $this->table;
        $id = $row['id']??'';
        $row['_id'] = md5($table.$id);
        $row['created_at'] = $row['created_at']??'';
        // _json($row);
        return $row;
    }

    public function prepareRows($objs)
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
            $row = $this->prepare($row);
        }
        
        return $rows;
    }

    // public function select(array $data = [])
    // {
    //     $objs = parent::select($data);
    //     // _test();
    //     // _test($objs);
    //     $objs = $objs->toArray();
    //     $rows = [];
    //     foreach($objs as &$obj){
    //         $id = $obj['id'];
    //         $rows[$id] = $obj;
    //     }
    //     // _test($rows);
    //     $rows = $this->prepareRows($rows);
    //     return $rows;
    // }

    public function withFkId($objs = [])
    {
        $rows = [];
        foreach($objs as &$obj){
            $id = $obj['fk_id'];
            $rows[$id] = $obj;
        }
        // $rows = $this->prepareRows($rows);
        return $rows;
    }

    public function find($data = null)
    {
        $row = parent::find($data);
        // $row = $row->toArray();
        $row = $this->prepare($row);
        return $row;
    }

    public function reset()
    {
        $this->_w2 = null;
    }

    /*
    FK資料集綁定 PK資料
    */
    public function bindRowsFk(&$rows, $rowsPk, $fk_id_fieldname = 'fk_id')
    {
        foreach($rows as &$row){
            $row = $this->bindRowFk($row, $rowsPk, $fk_id_fieldname);
        }
        return $rows;
    }

    /*
    @return 
    $row['dataFk'] = $rowPk;
    */
    public function bindRowFk(&$row, $rowsPk, $fk_id_fieldname = 'fk_id')
    {
        $fk_id = $row[$fk_id_fieldname];
        $row['dataFk'] = [];
        if(empty($fk_id)){ return $row; }
        if(empty($rowsPk)){ return $row; }
        if(isset($rowsPk[$fk_id])){
            $row['dataFk'] = $rowsPk[(string)$fk_id];
            // _j($row['dataFk']);
        }
        return $row;
    }

    /*
    PK資料集綁定 FK資料
    @tip
    事先把$rowsFk執行withFkId(), 把陣列index改為 PK ID
    */
    public function bindRowsPk(&$rows, &$rowsFk, $_rowName = 'dataXXX')
    {
        foreach($rows as &$row){
            $row = $this->bindRowPk($row, $rowsFk, $_rowName);
        }
        return $rows;
    }

    /*
    @return 
    $row['dataXXX'] = $rowFk;
    */
    public function bindRowPk(&$row, &$rowsFk, $_rowName = 'dataXXX')
    {
        $pk_id = $row['id'];
        $row[$_rowName] = [];
        if(empty($pk_id)){ return $row; }
        if(empty($rowsFk)){ return $row; }
        if(isset($rowsFk[$pk_id])){
            $row[$_rowName] = $rowsFk[$pk_id];
        }
        return $row;
    }

    public function select2(array $data = [])
    {
        if($this->_w2){
            $objs = parent::where($this->_w2)->select($data);
        }else{
            $objs = parent::select($data);
        }
        $rows = $this->prepareRows($objs);
        return $rows;
    }

    public function find2($data = null)
    {
        if($this->_w2){
            $row = parent::where($this->_w2)->find($data);
        }else{
            $row = parent::find($data);
        }
        $row = $this->prepare($row);
        return $row;
    }
    
    /*
    @field
        create_at
    */
    public function add2(array $data = []){
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_time'] = time();
        return $this->insertGetId($data);
        // return $this->insert($data);
    }
    
    /**
     * 保存当前数据对象
     *
     * @param array|object  $data     数据
     * @param string $sequence 自增序列名
     *
     * @return bool
     */
    public function save2($data = [], $sequence = null)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['updated_time'] = time();
        $aff = $this->save($data, $sequence);
        return $aff;
    }
    
    /*
    結合前一個where條件
    */
    public function w($where){
        $_w = $this->where($where);
        $this->w = $_w;
        return $_w;
    }
    public function debug2(){
        _test($this->_w2);
    }
    public function getW(){
        return $this->_w;
    }
    public function getW2(){
        return $this->_w2;
    }
    public function where2($field = null, $op = null, $condition = null){
        if(empty($field)){
            if($this->_w2){
                return $this->where($this->_w2);
            }else{
                return $this->where($field, $op, $condition);
            }
        }else{
            if($this->_w2){
                $this->_w2 = $this->where($this->_w2)->where($field, $op, $condition);
            }else{
                $this->_w2 = $this->where($field, $op, $condition);
            }
            return $this;
        }
    }
    
    // public function where2($field = null, $op = null, $condition = null){
    //     if(empty($field)){
    //         if($this->_w2){
    //             return $this->_w2;
    //         }else{
    //             return $this->where($field, $op, $condition);
    //         }
    //     }else{
    //         $where = $this
    //         ->where($this->_w2)
    //         ->where($field, $op, $condition);
    //         $this->_w2 = $where;
    //         return $this->_w2;
    //     }
    // }


    /**
     * 指定OR查询条件.
     *
     * @param mixed $field     查询字段
     * @param mixed $op        查询表达式
     * @param mixed $condition 查询条件
     *
     * @return $this
     */
    public function whereOr2($field = null, $op = null, $condition = null)
    {
        $param = func_get_args();
        array_shift($param);

        return $this->parseWhereExp('OR', $field, $op, $condition, $param);
    }

    /**
     * 指定XOR查询条件.
     *
     * @param mixed $field     查询字段
     * @param mixed $op        查询表达式
     * @param mixed $condition 查询条件
     *
     * @return $this
     */
    public function whereXor2($field, $op = null, $condition = null)
    {
        $param = func_get_args();
        array_shift($param);

        return $this->parseWhereExp('XOR', $field, $op, $condition, $param);
    }

    /**
     * 指定Null查询条件.
     *
     * @param mixed  $field 查询字段
     * @param string $logic 查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereNull2(string $field, string $logic = 'AND')
    {
        return $this->parseWhereExp($logic, $field, 'NULL', null, [], true);
    }

    /**
     * 指定NotNull查询条件.
     *
     * @param mixed  $field 查询字段
     * @param string $logic 查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereNotNull2(string $field, string $logic = 'AND')
    {
        return $this->parseWhereExp($logic, $field, 'NOTNULL', null, [], true);
    }

    /**
     * 指定Exists查询条件.
     *
     * @param mixed  $condition 查询条件
     * @param string $logic     查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereExists2($condition, string $logic = 'AND')
    {
        if (is_string($condition)) {
            $condition = new Raw($condition);
        }

        $this->options['where'][strtoupper($logic)][] = ['', 'EXISTS', $condition];

        return $this;
    }

    /**
     * 指定NotExists查询条件.
     *
     * @param mixed  $condition 查询条件
     * @param string $logic     查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereNotExists2($condition, string $logic = 'AND')
    {
        if (is_string($condition)) {
            $condition = new Raw($condition);
        }

        $this->options['where'][strtoupper($logic)][] = ['', 'NOT EXISTS', $condition];

        return $this;
    }

    /**
     * 指定In查询条件.
     *
     * @param mixed  $field     查询字段
     * @param mixed  $condition 查询条件
     * @param string $logic     查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereIn2(string $field, $condition, string $logic = 'AND')
    {
        return $this->parseWhereExp($logic, $field, 'IN', $condition, [], true);
    }

    /**
     * 指定NotIn查询条件.
     *
     * @param mixed  $field     查询字段
     * @param mixed  $condition 查询条件
     * @param string $logic     查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereNotIn2(string $field, $condition, string $logic = 'AND')
    {
        return $this->parseWhereExp($logic, $field, 'NOT IN', $condition, [], true);
    }

    /**
     * 指定Like查询条件.
     *
     * @param mixed  $field     查询字段
     * @param mixed  $condition 查询条件
     * @param string $logic     查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereLike2(string $field, $condition, string $logic = 'AND')
    {
        return $this->parseWhereExp($logic, $field, 'LIKE', $condition, [], true);
    }

    /**
     * 指定NotLike查询条件.
     *
     * @param mixed  $field     查询字段
     * @param mixed  $condition 查询条件
     * @param string $logic     查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereNotLike2(string $field, $condition, string $logic = 'AND')
    {
        return $this->parseWhereExp($logic, $field, 'NOT LIKE', $condition, [], true);
    }

    /**
     * 指定Between查询条件.
     *
     * @param mixed  $field     查询字段
     * @param mixed  $condition 查询条件
     * @param string $logic     查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereBetween2(string $field, $condition, string $logic = 'AND')
    {
        return $this->parseWhereExp($logic, $field, 'BETWEEN', $condition, [], true);
    }

    /**
     * 指定NotBetween查询条件.
     *
     * @param mixed  $field     查询字段
     * @param mixed  $condition 查询条件
     * @param string $logic     查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereNotBetween2(string $field, $condition, string $logic = 'AND')
    {
        return $this->parseWhereExp($logic, $field, 'NOT BETWEEN', $condition, [], true);
    }

    /**
     * 指定FIND_IN_SET查询条件.
     *
     * @param mixed  $field     查询字段
     * @param mixed  $condition 查询条件
     * @param string $logic     查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereFindInSet2(string $field, $condition, string $logic = 'AND')
    {
        return $this->parseWhereExp($logic, $field, 'FIND IN SET', $condition, [], true);
    }

    /**
     * 比较两个字段.
     *
     * @param string $field1   查询字段
     * @param string $operator 比较操作符
     * @param string $field2   比较字段
     * @param string $logic    查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereColumn2(string $field1, string $operator, string $field2 = null, string $logic = 'AND')
    {
        if (is_null($field2)) {
            $field2 = $operator;
            $operator = '=';
        }

        return $this->parseWhereExp($logic, $field1, 'COLUMN', [$operator, $field2], [], true);
    }

    /**
     * 指定Exp查询条件.
     *
     * @param mixed  $field 查询字段
     * @param string $where 查询条件
     * @param array  $bind  参数绑定
     * @param string $logic 查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereExp2(string $field, string $where, array $bind = [], string $logic = 'AND')
    {
        $this->options['where'][$logic][] = [$field, 'EXP', new Raw($where, $bind)];

        return $this;
    }

    /**
     * 指定字段Raw查询.
     *
     * @param string $field     查询字段表达式
     * @param mixed  $op        查询表达式
     * @param string $condition 查询条件
     * @param string $logic     查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereFieldRaw2(string $field, $op, $condition = null, string $logic = 'AND')
    {
        if (is_null($condition)) {
            $condition = $op;
            $op = '=';
        }

        $this->options['where'][$logic][] = [new Raw($field), $op, $condition];

        return $this;
    }

    /**
     * 指定表达式查询条件.
     *
     * @param string $where 查询条件
     * @param array  $bind  参数绑定
     * @param string $logic 查询逻辑 and or xor
     *
     * @return $this
     */
    public function whereRaw2(string $where, array $bind = [], string $logic = 'AND')
    {
        $this->options['where'][$logic][] = new Raw($where, $bind);

        return $this;
    }

    /**
     * 指定表达式查询条件 OR.
     *
     * @param string $where 查询条件
     * @param array  $bind  参数绑定
     *
     * @return $this
     */
    public function whereOrRaw2(string $where, array $bind = [])
    {
        return $this->whereRaw($where, $bind, 'OR');
    }    
    
    public function where2Status($params = array(), $where2 = array()){
        $status = $params['status']??'all';
        switch($status){
            default:
            case 'all':
                break;
            case 'valid':
                $this->where2('is_remove', '0');
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
    
    public function where2AnyField($field, $params = array(), $where2 = array()){
        $_field = $field;
        if(is_array($params)){
            $id = $params[$_field]??'';
        }else{
            $id = $params??'';
        }
        if($id){
            $this->where2($_field, $id);
        }
        return $this;
    }
    
    public function where2Id($params = array(), $where2 = array()){
        $_field = 'id';
        $this->where2AnyField($_field, $params, $where2);
        return $this;
    }
    
    public function where2FkId($params = array(), $where2 = array()){
        $_field = 'fk_id';
        $this->where2AnyField($_field, $params, $where2);
        return $this;
    }
    
    public function where2WebId($params = array(), $where2 = array()){
        $id = \Web::id();
        if($id){
            $this->where2('web_id', $id);
        }
        return $this;
    }
    
    public function where2SchoolId($params = array(), $where2 = array()){
        $id = \School::id();
        if($id){
            $this->where2('school_id', $id);
        }
        return $this;
    }
    
    public function touch($where2 = [], $touch_dataset = []){
        if(empty($where2)){ return false; }
        if(empty($touch_dataset)){ return false; }
        $id = \Web::id();
        foreach($where2 as $k => $v){
            $this->where2($k, $v);
        }
        $data = $this->where2()->find();
        if($data){ return $data; }
        
        $dataset = [];
        foreach($touch_dataset as $k => $v){
            $dataset[$k] = $v;
        }
        // _j($dataset);
        $insert_id = $this->insertGetId($dataset);
        $data = $this->where('id', $insert_id)->find();
        return $data;
    }
    
    public function touchByFkId($fk_id){
        if(empty($fk_id)){ return false; }
        $id = \Web::id();
        $this->where2('web_id', $id);
        $this->where2('fk_id', $fk_id);
        $data = $this->where2()->find();
        if($data){ return $data; }

        $dataset = [];
        $dataset['web_id'] = $id;
        $dataset['fk_id'] = $fk_id;
        $insert_id = $this->insertGetId($dataset);
        $data = $this->where('id', $insert_id)->find();
        return $data;
    }
    
    public function schemaRow()
    {
        $row = $this->where('is_schema','1')->find();
        if(empty($row)){
            $dataset = [];
            $dataset['is_schema'] = '1';
            $id = $this->add2($dataset);
            $row = $this->where('id', $id)->find($id);
        }
        $row = $this->prepare($row);
        return $row;
    }

}