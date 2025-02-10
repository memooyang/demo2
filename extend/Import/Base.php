<?php
/*
NOUSE
*/
/*
$_FILES[0]["name"]：上傳檔案的原始名稱。
$_FILES[0]["type"]：上傳的檔案類型。
$_FILES[0]["size"]：上傳的檔案原始大小。
$_FILES[0]["tmp_name"]：上傳檔案後的暫存資料夾位置。
$_FILES[0]["error"]：如果檔案上傳有錯誤，可以顯示錯誤代碼。
*/
class Import_Base
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
    public $uploader_options = array(
        'file_exts' => array('csv'),
        'file_max_size' => 1073741824,
    );
    
    //-----
    public $dir_path = './public/files-import/'; 
    
    public $file_fullname = ''; // xxx
    public $file_name = ''; // xxx
    public $file_ext = ''; // csv
    public $file_type = ''; // text/plain ...etc
    public $file_size = ''; 
    
    public $new_file_fullname = ''; // xxx
    public $new_file_name = ''; // xxx
    public $new_file_ext = ''; // csv
    public $new_file_path = ''; // ./Public/files-import/xxx.csv

    //-----
    public $file = null; 
    public $uploader = null;
    public $fp = null;
    
    //-----
    public $upload_result = array();
    
    public function __construct()
    {
        //-----
        $school_id = C('SCHOOL_ID');
        $this->school_id = $school_id;
        
        //-----
        if(!file_exists($this->dir_path)){
            mkdir($this->dir_path, 0775, true); 
            //-----
            $exec0 = "sudo chmod 775 -R " . $this->dir_path;
            $aff = exec($exec0);
        }
        
    }
    
    public function validate()
    {
        if($this->file['error']){ throw new \Exception('上傳文件出現錯誤'); }
        if(empty($this->file['size'])){ throw new \Exception('文件大小不能為0'); }
        if(empty($this->new_file_name)){ throw new \Exception('未設定文件名稱'); }
    }
    
    public function initFileInfo($params = array())
    {
        // _json($params);
        //-----
        $file_fullname = $params['name'];
        $this->file_fullname = $file_fullname;
        
        //-----
        $arr_file_name = explode('.', $file_fullname);
        $file_ext = array_pop($arr_file_name);
        $file_name = implode('.', $arr_file_name);
        $this->file_name = $file_name;
        $this->file_ext = $file_ext;
        
        // _json($arr_file_name);
        // _json($file_name);
        // _json($file_ext);
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
    @params array(
        ['file'] => array(
            id
            name
            type
            size
        )
    )
    */
    public function initForBeforeUpload($params = array())
    {
        //-----
        $this->params = $params;
        
        //-----
        // $this->file = array_values($_FILES)[0];
        // _json($_FILES);
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
    public function doBeforeUpload($params = array())
    {
        //-----
        $this->validate();
        
        //-----
        $uploader = new \Think\Upload(); 
        $uploader->maxSize = $this->uploader_options['file_max_size']; 
        $uploader->exts = $this->uploader_options['file_exts']; 
        $uploader->rootPath = $this->dir_path; 
        $uploader->autoSub  = false;
        // $upload->subName  = array('date', 'Ymd');
        $uploader->saveName = $this->new_file_name;
        $this->uploader = $uploader;
    
        //-----
        $this->upload_result =  $uploader->uploadOne($this->file);
        // _json($this->upload_result);
        
        // //-----
        // $this->addLog();
        
        //-----
        // setlocale(LC_ALL, 'zh_TW.BIG5');
        // ini_set("memory_limit", "1024M");
        // ob_clean();
        $response = array();
        $response['log_id'] = $this->instance['dataLog']['id'];
        $response['upload_result'] = $this->upload_result;
        return $response;
    }
    
    /*
    */
    // public function addLog()
    // {
    //     $user = \School::user();
    //     $log = new \Rdb_ManageImportLog();
    //     $dataset = array();
    //     $dataset['user_id'] = $user['id'];
    //     $dataset['user_role'] = $user['role'];
    //     $dataset['school_id'] = $this->school_id;
    //     $dataset['topic'] = $this->topic;
    //     $dataset['type'] = $this->type;
    //     // $dataset['file_id'] = $this->file['id'];
    //     $dataset['file_fullname'] = $this->file_fullname;
    //     $dataset['file_name'] = $this->file_name;
    //     $dataset['file_ext'] = $this->file_ext;
    //     $dataset['file_type'] = $this->file['type'];
    //     $dataset['file_size'] = $this->file['size'];
    //     $dataset['new_file_fullname'] = $this->new_file_fullname;
    //     $dataset['new_file_name'] = $this->new_file_name;
    //     $dataset['host'] = $_SERVER['HTTP_HOST'];
    //     $dataset['module'] = MODULE_NAME;
    //     $dataset['controller'] = CONTROLLER_NAME;
    //     $dataset['action'] = ACTION_NAME;
    //     $dataset['created_at'] = _date();
    //     $dataset['ip'] = _ip();
    //     // $dataset['file_data'] = json_encode($this->file);
    //     $aff = $log->add($dataset);
    //     $this->instance['dataLog'] = $log->findById($aff);
    // }
    
    /*
    */
    // public function getLog($log_id = '')
    // {
    //     if($this->instance['dataLog']){ return $this->instance['dataLog']; }
    //     $log = new \Rdb_ManageImportLog();
    //     $this->instance['dataLog'] = $log->findById($log_id);
    //     return $this->instance['dataLog'];
    // }
    
    public function initForAfterUpload($params = array())
    {
        //-----
        $this->params = $params;
        _json($this->params);
        
        //-----
    }
    
    public function doAfterUpload($params = array())
    {
        //-----
        $this->params = $params;
        _json($this->params);
        
        //-----
    }
}