<?php
class Import_Csv_BeforeUpload extends Import_Csv_Base
{
    public $file_id = ''; // xxx
    public $file_fullname = ''; // xxx
    public $file_name = ''; // xxx
    public $file_ext = ''; // csv
    public $file_type = ''; // text/plain ...etc
    public $file_size = ''; 
    
    public $new_file_fullname = ''; // xxx
    public $new_file_name = ''; // xxx
    public $new_file_path = ''; // ./Public/files-import/xxx.csv
    
    public function __construct()
    {
        parent::__construct();
        
    }
    
    /*
    @params array
    {
        "file": {
            "id": "o_1ead2f68e1jqp10bjo7qhmj9818",
            "name": "student.csv",
            "size": "202360",
            "type": "application/vnd.ms-excel"
        },
    },
    */
    public function init($params = array())
    {
        //-----
        $this->params = $params;
        //_json("doUploaded_int:".$this->params['group_id']); //2021/09/14 by vivia
       //  _json("Import_Csv_Base:".$this->params);
        
        //-----
        $this->initFileInfo($this->params['file']);
        $this->buildNewFileInfo();
        
        if(empty($this->file_size)){ throw new \Exception('文件大小不能為0'); }
        if(empty($this->new_file_name)){ throw new \Exception('未設定文件名稱'); }
    }
    
    public function initFileInfo($file = array())
    {
        // _json($params);
        //-----
        //_json("initFileInfo:".$this->params['group_id']); //2021/09/14 by vivia
        
        $file_id = $file['id'];
        $file_fullname = $file['name'];
        $file_size = $file['size'];
        $file_type = $file['type'];
        $this->file_id = $file_id;
        $this->file_fullname = $file_fullname;
        $this->file_size = $file_size;
        $this->file_type = $file_type;
        
        //-----
        $arr_file_name = explode('.', $file_fullname);
        $file_ext = array_pop($arr_file_name);
        $file_name = implode('.', $arr_file_name);
        $this->file_name = $file_name;
        $this->file_ext = $file_ext;
        
        $this->group_id = $this->params['group_id'];//2021/09/14 by vivia 
        //_json("this:".$this->group_id);//2021/09/14 by vivia 
    }
    
    public function buildNewFileInfo()
    {
        //-----
        $type = $this->type;
        $school_id = $this->school_id;
        $file_ext = $this->file_ext;
        
        //-----
        $time = explode('.', microtime(true));
        $time = implode('', $time);
        $new_file_name = "{$school_id}-{$type}-{$time}";
        $this->time = $time;
        $this->new_file_name = $new_file_name;
        $new_file_fullname = "{$new_file_name}.{$file_ext}";
        $this->new_file_fullname = $new_file_fullname;
        
        //-----
        $dir_path = $this->dir_path;
        $new_file_path = "{$dir_path}{$new_file_fullname}";
        $this->new_file_path = $new_file_path;
    }
    
    /*
    */
    public function touchImportFile()
    {
        $user = \School::user();
        $rdb = new \Rdb_ImportFile();
        $dataset = array();
        $dataset['school_id'] = $this->school_id;
        $dataset['user_id'] = $user['id'];
        $dataset['user_role'] = $user['role'];
        $dataset['is_rewrite_data'] = ($this->params['is_rewrite_data'])?'1':'0';
        $dataset['group_id'] = $this->params['group_id'];  //2021/09/14 by vivia
        $dataset['topic'] = $this->topic;
        $dataset['type'] = $this->type;
        $dataset['file_id'] = $this->file_id;
        $dataset['file_fullname'] = $this->file_fullname;
        $dataset['file_name'] = $this->file_name;
        $dataset['file_ext'] = $this->file_ext;
        $dataset['file_size'] = $this->file_size;
        $dataset['file_type'] = $this->file_type;
        $dataset['new_file_fullname'] = $this->new_file_fullname;
        $dataset['new_file_name'] = $this->new_file_name;
        $dataset['new_file_path'] = $this->new_file_path;
        $dataset['host'] = $_SERVER['HTTP_HOST'];
        $dataset['module'] = MODULE_NAME;
        $dataset['controller'] = CONTROLLER_NAME;
        $dataset['action'] = ACTION_NAME;
        $dataset['created_at'] = _date();
        $dataset['setting'] = json_encode($this->params['__SETTING__']);
        $dataset['ip'] = _ip();
        $aff = $rdb->add($dataset);
        return $aff;
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
        $ref_id = $this->touchImportFile();
        //$this->group_id = $this->params['group_id'];//2021/09/14 by vivia 
        //_json("doProcess1:".$this->group_id); //2021/09/14 by vivia 有值
        //_json("doProcess2:".$this->params['group_id']); //2021/09/14 by vivia 
        
        //-----
        $response = array();
        $response['ref_id'] = $ref_id;
        $response['group_id'] = $this->params['group_id']; //2021/09/14 by vivia 
        $response['host'] = $_SERVER['HTTP_HOST'];
        return $response;
    }
    
}