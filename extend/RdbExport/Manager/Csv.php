<?php
/*
\RdbExport\AdminUsers\Csv
*/
namespace RdbExport\AdminUsers;

class Csv extends \Export\Csv
{
    public $file_name = '管理者';
    
    public function initDatalist()
    {
        //-----
        try{
            // if(\Analytics_Service::hasService() == false){ throw new \Exception('NO SERVICE'); }
            //-----
            $rdb = new \Rdb\AdminUsers();
            if(\Auth::isInternalAccount()){
            }else{
                $rdb->where2('is_internal_account', 0);
                $rdb->where2SelectRole();
            }
            // $rdb->where2('is_remove', 0);
            // $rdb->where2('is_lock', 0);
            // $rdb->where2('name', 'like', '測%');
            // $rdb->where2('login_at', '>', '2024-03-16 00:00:00');
            $rows = $rdb->select2();
            $this->datalist = $rows;
            if(empty($this->datalist)){ throw new \Exception('沒有對應的資料'); }
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }  
    
    public function buildFile($datalist = array())
    {
        try{
            if(empty($datalist)){ throw new \Exception('沒有對應的資料'); }
            $fp = $this->fp;
            
            //-----
            $dataWeb = \Web::data();
            if(empty($dataWeb)){ throw new \Exception('沒有網校ID'); }
            
            //-----
            $csv_field_name = array(
                \Helper\Csv\Text::_("姓名"),
                \Helper\Csv\Text::_("顯示名稱"),
                \Helper\Csv\Text::_("Email"),
                \Helper\Csv\Text::_("聯絡電話"),
                \Helper\Csv\Text::_("聯絡手機"),
                \Helper\Csv\Text::_("建立日期"),
            );
            fputcsv($fp, $csv_field_name);
            
            //-----
            foreach($datalist as &$row){
                $arr = array();
                $arr[] = \Helper\Csv\Text::_($row['name']);
                $arr[] = \Helper\Csv\Text::_($row['nickname']);
                $arr[] = \Helper\Csv\Text::_($row['email']);
                $arr[] = \Helper\Csv\Text::_($row['tel']);
                $arr[] = \Helper\Csv\Text::_($row['mobile']);
                $arr[] = \Helper\Csv\Text::_($row['created_at']);
                fputcsv($fp, $arr);
            }
            fclose($fp);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
        
    }
    
}