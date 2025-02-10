<?php
/*
$_FILES[0]["name"]：上傳檔案的原始名稱。
$_FILES[0]["type"]：上傳的檔案類型。
$_FILES[0]["size"]：上傳的檔案原始大小。
$_FILES[0]["tmp_name"]：上傳檔案後的暫存資料夾位置。
$_FILES[0]["error"]：如果檔案上傳有錯誤，可以顯示錯誤代碼。
*/
class Import_Csv_Base
{
    //-----
    public $params = null; 
    
    //-----
    public $topic = '匯入檔案';
    public $type = 'student';
    public $time = '';
    
    //-----
    public $school_id = null;
    public $rdb = null;
    public $instance = array();
    
    //-----
    public $dir_path = './public/files-import/'; 
    
    public function __construct()
    {
        //-----
        if(!file_exists($this->dir_path)){
            mkdir($this->dir_path, 0775, true); 
            //-----
            $exec0 = "sudo chmod 775 -R " . $this->dir_path;
            $aff = exec($exec0);
        }
    }
    
    public function buildNewFileInfo()
    {
        //-----
        $school_id = C('SCHOOL_ID');
        
        //-----
        $file_ext = $this->file_ext;
        $type = $this->type;
        $time = explode('.', microtime(true));
        $time = implode('', $time);
        $new_file_name = "{$school_id}-{$type}-{$time}";
        $this->time = $time;
        $this->new_file_fullname = "{$new_file_name}.{$file_ext}";
        $this->new_file_name = $new_file_name;
        
        //-----
        $dir_path = $this->dir_path;
        $new_file_path = "{$dir_path}{$new_file_name}.{$file_ext}";
        $this->new_file_path = $new_file_path;
        
        // _json($file_name);
        // _json($file_ext);
        // _json($new_file_path);
    }
    
    /*
    */
    public function getImportFile($ref_id = '')
    {
        $dataImportFile = $this->instance['dataImportFile'];
        if(empty($dataImportFile)){
            $rdb = new \Rdb_ImportFile();
            $map = array();
            $map['school_id'] = $this->school_id;
            $map['id'] = $ref_id;
            $dataImportFile = $rdb->where($map)->find();
            $this->instance['dataImportFile'] = $dataImportFile;
        }
        return $dataImportFile;
    }
    
    /*
    @params array(
        ['file'] => array(
            id
            name
            type
            size
        )
    )
    */
    public function init($params = array())
    {
        //-----
        $this->params = $params;
        
        //-----
        _json($this->params);
        
        //-----
        $this->initFileInfo($this->params['file']);
        $this->buildNewFileInfo();
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
        $this->validate();
    }
    
}