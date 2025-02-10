<?php
/*
$_FILES[0]["name"]：上傳檔案的原始名稱。
$_FILES[0]["type"]：上傳的檔案類型。
$_FILES[0]["size"]：上傳的檔案原始大小。
$_FILES[0]["tmp_name"]：上傳檔案後的暫存資料夾位置。
$_FILES[0]["error"]：如果檔案上傳有錯誤，可以顯示錯誤代碼。
*/
class Import_Csv_Uploaded extends Import_Csv_Base
{
    //-----
    public $file = null;
    
    //-----
    public $uploader = null;
    public $uploader_options = array(
        'file_exts' => array('csv'),
        'file_max_size' => 1073741824,
    );
    public $upload_result = array();
    
    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function init($params = array())
    {
        // _json($params);
        
        //-----
        $this->params = $params;
        if(empty($this->params['ref_id'])){ throw new \Exception('沒有對應的匯入記錄'); }
        
        //-----
        $this->file = array_values($_FILES)[0];
        if(empty($this->file)){ throw new \Exception('沒有檔案資訊'); }
    }
    
    /*
    @upload_result
        ext: "csv"
        key: 0
        md5: "4110347d47131e705df9945e47efb1bd"
        name: "student.csv"
        savename: "319-student-15916995550184.csv"
        savepath: ""
        sha1: "2372b4a6fb9580ae80e41fedbd302b724df6980e"
        size: 202360
        type: "text/plain"    
    */
    public function doProcess()
    {
        //-----
        $dataImportFile = $this->getImportFile($this->params['ref_id']);
        
        //-----
        $uploader = new \Think\Upload(); 
        $uploader->maxSize = $this->uploader_options['file_max_size']; 
        $uploader->exts = $this->uploader_options['file_exts']; 
        $uploader->rootPath = $this->dir_path; 
        $uploader->autoSub  = false;
        // $upload->subName  = array('date', 'Ymd');
        $uploader->saveName = $dataImportFile['new_file_name'];
        $this->uploader = $uploader;
    
        //-----
        $this->upload_result =  $uploader->uploadOne($this->file);
        // _json($this->upload_result);
        
        //-----
        try{
            if(!file_exists($dataImportFile['new_file_path'])){
                $exec0 = "sudo chmod 775 -R {$dataImportFile['new_file_path']}" ;
                $aff = exec($exec0);
            }
        }catch(\Exception $e){
        }
        
        //-----
        // setlocale(LC_ALL, 'zh_TW.BIG5');
        // ini_set("memory_limit", "1024M");
        // ob_clean();
        $response = array();
        $response['upload_result'] = $this->upload_result;
        return $response;
    }
}