<?php
class Import_Csv_AfterUpload extends Import_Csv_Base
{
    //-----
    public $fp = null;
    
    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function init($params = array())
    {
        //-----
        $this->params = $params;
        if(empty($this->params['ref_id'])){ throw new \Exception('沒有對應的匯入記錄'); }
    }
    
    public function loadFile()
    {
        //-----
        $dataImportFile = $this->getImportFile($this->params['ref_id']);
        if(empty($dataImportFile)){ throw new \Exception('沒有對應的匯入記錄'); }
        // _json($dataImportFile);
        
        try{
            $fp = fopen($dataImportFile['new_file_path'], "r");
            $all = array();
            $rows = array();
            if($fp){
                $header = \CSV::load($fp, 2000);
                $all[] = $header;
                while(($row = \CSV::load($fp, 2000)) !== FALSE) {
                    $all[] = $row;
                    $rows[] = $row;
                }
                fclose($fp);
            }
        }catch(\Exception $e){
        }
        
        if(empty($rows)){ throw new \Exception('沒有匯入資料'); }
        // _json($rows);
        
        // //-----
        // $rdb = new \Rdb_ImportFileData();
        // $map = array();
        // $map['school_id'] = $this->school_id;
        // $map['parent_id'] = $dataImportFile['id'];
        // $dataset = array();
        // $dataset['school_id'] = $this->school_id;
        // $dataset['parent_id'] = $dataImportFile['id'];
        // // $dataset['data'] = json_encode($all);
        // $rdb->saving($dataset, null, $map);
        
        return $rows;
        
    }
    
    public function logDataError($data_error = array())
    {
        try{
            //-----
            if(empty($data_error)){ throw new \Exception('沒有匯入資料'); }
            
            //-----
            $dataImportFile = $this->getImportFile($this->params['ref_id']);
            if(empty($dataImportFile)){ throw new \Exception('沒有對應的匯入記錄'); }
            
            //-----
            $rdb = new \Rdb_ImportFileDataError();
            $map = array();
            $map['school_id'] = $this->school_id;
            $map['parent_id'] = $dataImportFile['id'];
            $dataset = array();
            $dataset['school_id'] = $this->school_id;
            $dataset['parent_id'] = $dataImportFile['id'];
            $dataset['data'] = json_encode($data_error);
            $rdb->add($dataset, null, $map);
        }catch(\Exception $e){
        }
    }
    
    public function doProcess()
    {
    }
}