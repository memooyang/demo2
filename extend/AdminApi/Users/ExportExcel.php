<?php
/*
\AdminApi\Users\ExportExcel
*/
namespace AdminApi\Users;

class ExportExcel extends \Export\Excel
{
    public function init($params = [])
    {
        parent::init($params);
        $this->file_name = '會員資料-'.date('YmdHis');
    }
    
    public function fetchRows()
    {
        //-----
        $web_id = \Web::id();
        $rdb = new \Rdb\Users();
        $map = [];
        $map['web_id'] = $web_id;
        $map['is_remove'] = '0';
        $rows = $rdb->where($map)->select();
        if(empty($rows)){ throw new \Exception('資料不存在'); }
        $rows = $rdb->prepareRows($rows);
        $this->vars['rows'] = $rows;
        // _json($rows);
        return $rows;
    }
    
    public function fetchRowsUserProfiles()
    {
        //-----
        $web_id = \Web::id();
        $rdb = new \Rdb\UserProfiles();
        $map = [];
        $map['web_id'] = $web_id;
        $rows = $rdb->where($map)->select();
        if(empty($rows)){ throw new \Exception('資料不存在'); }
        $rows = $rdb->prepareRows($rows);
        $rows = $rdb->rebuildWithField($rows, 'user_id');
        $this->vars['rowsUserProfiles'] = $rows;
        return $rows;
    }
    
    public function touchUserProfiles($user_id = 0)
    {
        //-----
        $web_id = \Web::id();
        $rdb = new \Rdb\UserProfiles();
        $map = [];
        $map['web_id'] = $web_id;
        $map['user_id'] = $user_id;
        $dataset = [];
        $dataset['web_id'] = $web_id;
        $dataset['user_id'] = $user_id;
        $row = $rdb->touchRecord($map, $dataset);
        return $row;
    }
    
    public function doProcess()
    {
        //-----
        $rows = $this->fetchRows();
        $rowsUserProfiles = $this->fetchRowsUserProfiles();
        
        //-----
        $table_header = [];
        $table_header[] = '會員編號';
        $table_header[] = '姓名';
        $table_header[] = '暱稱(LINE稱號)';
        $table_header[] = '性別';
        $table_header[] = '手機號碼';
        $table_header[] = '出生年月日';
        $table_header[] = '電子信箱(LINE綁定)';
        $table_header[] = '常用電子信箱';
        $table_header[] = '活動範圍(生活範圍)';
        $table_header[] = '縣市';
        $table_header[] = '鄉鎮市區';
        $table_header[] = '郵遞區號';
        $table_header[] = '街道地址';
        $table_header[] = '不接收任何通知（含 email 與 LINE 推播）';
        
        //-----
        $table_body = [];
        foreach($rows as $row){
            $arr = [];
            $user_id = $row['id'];
            if(array_key_exists($user_id, $rowsUserProfiles)){
                $rowUserProfiles = $rowsUserProfiles[$user_id];
            }else{
                // _test($user_id);
                $rowUserProfiles = $this->touchUserProfiles($user_id);
            }
            $arr[] = $row['__OUTPUT__']['sn'];
            $arr[] = $row['name']??'';
            $arr[] = $row['social_name']??'';
            $arr[] = $rowUserProfiles['__OUTPUT__']['gender'];
            $arr[] = $rowUserProfiles['phone']??'';
            $arr[] = $rowUserProfiles['__OUTPUT__']['birthday'];
            $arr[] = $rowUserProfiles['__OUTPUT__']['social_email'];
            $arr[] = $row['email']??'';
            $arr[] = $rowUserProfiles['lifes']??'';
            $arr[] = $rowUserProfiles['county']??'';
            $arr[] = $rowUserProfiles['district']??'';
            $arr[] = $rowUserProfiles['zipcode']??'';
            $arr[] = $rowUserProfiles['address']??'';
            $arr[] = \Helper\Select\YesNo::$kv[$row['is_reject_receive_any_notifications']];
            $table_body[] = $arr;
        }
        // _test($table_body);
        //-----輸出結果
        $this->build($table_header, $table_body);
        $result = [];
        $result['table_header'] = $table_header;
        $result['table_body'] = $table_body;
        return $result;
    }  
}