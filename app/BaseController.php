<?php
declare (strict_types = 1);

namespace app;

use think\App;
use think\exception\ValidateException;
use think\Validate;
use think\facade\View;

/**

 */
class BaseController
{
    public $identity = null;
    public $instance = array();
    public $mvc  = array();    //MVC INFO.
    public $args = array();    //DEFAULT CONFIG INFO.
    public $theme = array();    //DEFAULT CONFIG INFO.
    public $web = array();     //AUTO ASSIGN VARIABLE to VIEW
    public $vars = array();    //AUTO ASSIGN VARIABLE to VIEW
    public $urls = array();    //AUTO ASSIGN VARIABLE to VIEW
    public $path = array();    //AUTO ASSIGN VARIABLE to VIEW
    public $user = array();    //AUTO ASSIGN VARIABLE to VIEW
    public $admin = array();    //AUTO ASSIGN VARIABLE to VIEW
    public $company = array();    //AUTO ASSIGN VARIABLE to VIEW
    public $page = array();    //AUTO ASSIGN VARIABLE to VIEW
    public $date = array();    //AUTO ASSIGN VARIABLE to VIEW
    public $assigns = array();    //AUTO ASSIGN VARIABLE to VIEW
    
    public $params = array();
    public $log_ids = array();
    public $apiModule = '';
    public $htmlModule = '';
    public $thisModule = '';
    public $thisController = '';
    public $thisAction = '';
    public $thisTitle = '';
    public $thisUrl = '';
    public $thisBackUrl = '';
    public $tokenWithBearer = '';
    
    //-----
    public $prefixApi = '';
    
    //-----
    public $mdb_params  = array(); 
    
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;

        $this->identity = uniqid();
        $this->params = \think\facade\Request::param();
        // $this->params['backTo'] = $this->params['backTo']??'';
        // _json($this->params);
        $this->path['root'] = ROOT_PATH;
        $this->path['public'] = PUBLIC_PATH;
        $this->path['theme'] = PUBLIC_THEME_PATH;
        $this->path['layout'] = LAYOUT_PATH;
        $this->path['view'] = VIEW_PATH;
        
        //-----
        // $this->date['ymd'] = date('Y-m-d');
        // $this->date['ym'] = date('Y-m');
        // $this->date['md'] = date('m-d');
        // $this->date['m'] = date('m');
        // $this->date['d'] = date('d');
        // $this->date['n'] = date('n');
        // $this->date['ymdhis'] = date('Y-m-d H:i:s');
        // $this->date['ymdhi'] = date('Y-m-d H:i');
        // $this->date['ymdh'] = date('Y-m-d H');
        // $this->date['his'] = date('H:i:s');
        // $this->date['hi'] = date('H:i');
        // $this->date['h'] = date('H');
        
        //-----
        $this->thisUrl = $this->thisUrl();
        $this->thisBackUrl = $this->thisBackUrl();
        
        // 控制器初始化
        $this->initialize();
    }

    protected function initialize()
    {
        // $arr = \think\facade\Db::name('lohasys_web')
        // ->where('id', '1')
        // ->find();
        // _test($arr);
        $web_id = \Env::get('WEB_ID');
        $this->web = \Web::initById($web_id);
        // $this->web = \Web::data();
        // $this->user = \Web::user();
        $this->initUrls();
        $this->initUser();
        $this->AliveMonitor();
    }

    protected function AliveMonitor()
    {
        // \CurlThread::AliveMonitor();
        
        // $web_id = $this->web['id']??'';
        // $mode = $this->web['mode']??'';
        // $domain = $this->web['domain']??'';
        // $url = 'https://use4.app/AliveMonitor/Check/Alive'; 
        // $data = [
        //   'web_id' => $web_id,
        //   'mode' => $mode,
        //   'domain' => $domain,
        // ];

        // $urls = [
        //     "{$url}?web_id={$web_id}&mode={$mode}&domain={$domain}",
        // ];

        // $mh = curl_multi_init();

        // $handles = [];
        // foreach ($urls as $url) {
        //     $ch = curl_init($url);
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     curl_multi_add_handle($mh, $ch);
        //     $handles[] = $ch;
        // }

        // $running = null;
        // do {
        //     curl_multi_exec($mh, $running);
        // } while ($running > 0);

        // foreach ($handles as $ch) {
        //     $res = curl_multi_getcontent($ch);
        //     $info = curl_getinfo($ch);
        //     // echo "URL: {$info['url']}, HTTP Code: {$info['http_code']}\n";
        //     $httpCode = $info['http_code']??'';
        //     if ($httpCode >= 200 && $httpCode < 300) {
        //         if($res){
        //             $res = json_decode($res, true);
        //             if(array_key_exists('status', $res)){
        //                 if($res['status'] == 'error'){
        //                     $_params = [];
        //                     $_params['message'] = $res['message'];
        //                     $this->logAliveMonitorError($_params);
        //                 }
        //             }
        //         }
                
        //     } else {
        //     }            
        //     // Process the response here...
        //     curl_close($ch);
        // }

        // curl_multi_close($mh);

        // //--------------------
        // $ch = curl_init($url);
        // // Set cURL options
        // curl_setopt_array($ch, [
        //     CURLOPT_RETURNTRANSFER => true, // Return response as string
        //     CURLOPT_POST => true, // Use POST method (change to CURLOPT_PUT for PUT, etc.)
        //     CURLOPT_POSTFIELDS => http_build_query($data), // Send data as query parameters
        //     // Alternatively, for JSON data:
        //     // CURLOPT_POSTFIELDS => json_encode($data),
        //     // CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        //     CURLOPT_TIMEOUT => 1, // Timeout after 30 seconds
        //     CURLOPT_CONNECTTIMEOUT => 1, // Connection timeout after 10 seconds
        //     CURLOPT_FOLLOWLOCATION => true, // Follow redirects (use with caution)
        //     CURLOPT_SSL_VERIFYPEER => false, // Disable SSL certificate verification (use with caution in production!)
        // ]);
        // // Execute the cURL request
        // $res = curl_exec($ch);
        // // Check for errors
        // if(curl_errno($ch)){
        // } else {
        //     // Check HTTP status code
        //     $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //     if ($httpCode >= 200 && $httpCode < 300) {
        //         if($res){
        //             $res = json_decode($res, true);
        //             if(array_key_exists('status', $res)){
        //                 if($res['status'] == 'error'){
        //                     $_params = [];
        //                     $_params['message'] = $res['message'];
        //                     $this->logAliveMonitorError($_params);
        //                 }
        //             }
        //         }
                
        //     } else {
        //     }
        // }
        // // Close cURL resource
        // curl_close($ch);
    }

    protected function initUrls()
    {
        $this->urls['navIndex'] = $this->buildUrl();
        $this->urls['navLogin'] = $this->buildUrl('index', 'login');
        // $this->urls['navRegisterAccountSuccess'] = $this->buildUrl('index', 'RegisterAccountSuccess');
        // $this->urls['navActiveAccountSuccess'] = $this->buildUrl('index', 'ActiveAccountSuccess');
        // $this->urls['navActiveAccountError'] = $this->buildUrl('index', 'ActiveAccountError');
    }

    protected function initUserByToken()
    {
        try{
            $this->user = \Auth::checkUser($this->request);
            if(empty($this->user)){ return false; }
            if(empty($this->web)){ return false; }
            // if($this->user['web_id'] != $this->web['id']){ throw new \Exception('clear user'); }
        }catch(\Exception $e){
            // _test($e);
        }
    }

    protected function initAdminByToken()
    {
        try{
            $this->user = \Auth::checkAdmin($this->request);
            if(empty($this->user)){ return false; }
            if(empty($this->web)){ return false; }
            // if($this->user['web_id'] != $this->web['id']){ throw new \Exception('clear user'); }
        }catch(\Exception $e){
            // _test($e);
        }
    }

    protected function initUser()
    {
        try{
            $this->user = \Web::user();
            // _json($this->user);
            if(empty($this->user)){ return false; }
            if(empty($this->web)){ return false; }
            // if($this->user['web_id'] != $this->web['id']){ throw new \Exception('clear user'); }
        }catch(\Exception $e){
            \Session\User::_clear();
        }
    }

    public function assign($key, $value = '')
    {
        View::assign($key, $value);
    }

    /*
    渲染前端網頁
    */
    public function renderError($exception = '', string $template = '', array $params = [])
    {
        if(empty($template)){ $template = 'page/error404'; }
        if($exception){
            $message = $exception->getMessage();
            $params['error_message'] = $message;
        }
        return $this->render($template, $params);
    }

    /*
    渲染前端網頁
    */
    public function render(string $template = 'index', array $params = [])
    {
        foreach($this->assigns as $k => $v){
            $params[$k] =$v; 
        }
        $this->thisTitle = __($this->thisTitle);
        $params['identity'] = $this->identity;
        $params['instance'] = $this->instance;
        $params['vars'] = $this->vars;
        $params['urls'] = $this->urls;
        $params['theme'] = $this->theme;
        $params['web'] = $this->web;
        $params['args'] = $this->args;
        $params['path'] = $this->path;
        $params['user'] = $this->user;
        $params['company'] = $this->company;
        $params['page'] = $this->page; 
        $params['date'] = $this->date; 
        $params['params'] = $this->params; 
        $params['apiModule'] = $this->apiModule; 
        $params['htmlModule'] = $this->htmlModule; 
        $params['thisModule'] = $this->thisModule; 
        $params['thisController'] = $this->thisController; 
        $params['thisAction'] = $this->thisAction; 
        $params['thisTitle'] = $this->thisTitle; 
        $params['thisUrl'] = $this->thisUrl; 
        $params['thisBackUrl'] = $this->thisBackUrl; 
        $params['prefixApi'] = $this->prefixApi; 
        
        $params['uniqid1'] = uniqid(); 
        $params['uniqid2'] = uniqid(); 
        $params['uniqid3'] = uniqid(); 
        $params['uniqid4'] = uniqid(); 
        $params['uniqid5'] = uniqid(); 
        $params['uniqid6'] = uniqid(); 
        $params['uniqid7'] = uniqid(); 
        $params['uniqid8'] = uniqid(); 
        $params['uniqid9'] = uniqid(); 
        // _json($this->user);
        // _json($params);
        return View::fetch($template, $params);
    }

    public function setApiModule($str = '')
    {
        $this->apiModule = $str; 
        \Mvc::$apiModule = $str;
    }

    public function setHtmlModule($str = '')
    {
        $this->htmlModule = $str; 
        \Mvc::$htmlModule = $str;
    }

    public function setModule($str = 'Index')
    {
        $this->thisModule = $str; 
        \Mvc::$module = $str;
    }

    public function setController($str = 'Index')
    {
        $str = explode('\\', $str);
        $str = array_pop($str);
        $this->thisController = $str; 
        \Mvc::$controller = $str;
        return $str;
    }

    public function setAction($str = 'index')
    {
        $this->thisAction = $str; 
        \Mvc::$action = $str;
    }

    public function display(string $content, array $params = [])
    {
        return View::display($content, $params);
    }

    /*
    @use
    $this->url();
    @test
    Route::buildUrl('blog_read', ['id' => 5, 'name' => 'thinkphp']);
    @return
    /api/Index/blog_read.html?id=5&name=thinkphp
    */
    // public function url($url, $params = array())
    // {
    //     // $url = (string)\think\facade\Route::buildUrl($url, $params);
    //     // $url = str_replace('.html', '', $url);
    //     if($params){
    //         $query = http_build_query($params);
    //         $url = "{$url}?{$query}";
    //     }
    //     return $url;
    // }
    
    public function url($url, $params = array())
    {
        $url = $this->tp_buildUrl($url, $params);
        return $url;
    }

    public function tp_buildUrl($url, $params = array())
    {
        $data = (string)\think\facade\Route::buildUrl($url, $params);
        $data = str_replace('.html', '', $data);
        return $data;
    }

    public function thisUrl()
    {
        $data = (string)\think\facade\Route::buildUrl('', $this->params);
        $data = str_replace('.html', '', $data);
        return $data;
    }

    public function thisBackUrl()
    {
        $data = '';
        return $data;
    }

    public function setBackUrl($url = '')
    {
        $thisModule = $this->thisModule; 
        $this->thisBackUrl = "/{$thisModule}/{$url}";
        return $this->thisBackUrl;
    }

    public function nav($url, $params = array())
    {
        $url = $this->url($url, $params);
        header("Location: " . $url);
        exit;
        // return redirect($url, $params);
    }

    /*
    檢查用戶登入權限
    */
    public function checkAuth()
    {
        $user = \Web::user();
        if(empty($user)){
            $this->nav('/');
        }
    }

    public function apiSuccess($response = array())
    {
        \Api\Response::success($response);
        exit;
    }
    
    public function apiError($response = array())
    {
        \Api\Response::error($response);
        exit;
    }

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, string|array $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }

    /*
    */
    public function checkLogin()
    {
        if(empty($this->user)){ return $this->navLogin(); }
        return true;
    }

    public function buildUrl($controller = '', $action = '')
    {
        $url = '';
        if($this->thisModule){ $url .= '/'.$this->thisModule; }
        if($controller){ $url .= '/'.$controller; }
        if($action){ $url .= '/'.$action; }
        return $url;
    }

    public function navError404()
    {
        return $this->nav('/Error/Page/Http404', $this->params);
    }

    public function navError500()
    {
        return $this->nav('/Error/Page/Http500', $this->params);
    }

    public function navClientStageIndex()
    {
        return $this->nav('/Index/index/index');
    }

    public function navAdminStageIndex()
    {
        return $this->nav('/AdminStage/index/index');
    }

    public function navIndex()
    {
        $url = $this->urls[__FUNCTION__];
        return $this->nav($url);
    }

    public function navLogin()
    {
        $url = $this->urls[__FUNCTION__];
        return $this->nav($url);
    }

    public function navRegisterAccountSuccess()
    {
        $url = $this->urls[__FUNCTION__];
        return $this->nav($url);
    }

    /*
    https://use4.app/Teach/Index/ActiveAccountSuccess
    */
    public function navActiveAccountSuccess()
    {
        $url = $this->urls[__FUNCTION__];
        \Log::info($url);
        return $this->nav($url);
    }

    public function navActiveAccountError()
    {
        $url = $this->urls[__FUNCTION__];
        \Log::info($url);
        return $this->nav($url);
    }

    public function logException($e)
    {
    }

    public function logAliveMonitorError($params = [])
    {
        $web = \Web::data();
        if($web){
            $message = $params['message']??'No Message';
            $rdb = new \Rdb\LogAliveMonitorError();
            $map = array();
            $map['web_id'] = $web['id'];
            $map['mode'] = $web['mode'];
            $map['domain'] = $web['domain'];
            $dataset = array();
            $dataset['web_id'] = $web['id'];
            $dataset['mode'] = $web['mode'];
            $dataset['domain'] = $web['domain'];
            $dataset['message'] = $message;
            $dataset['module'] = $this->thisModule;
            $dataset['controller'] = $this->thisController;
            $dataset['action'] = $this->thisAction;
            // $aff = $rdb->add2($dataset);
            $aff = $rdb->touchRecord($map, $dataset);
        }
    }
    
    public function assignSettings()
    {
        $id = \Web::id();
        if(empty($id)){ throw new \Exception('沒有對應ID'); }
        $rdb = new \Rdb\Web();
        $map = [];
        $map['id'] = $id;
        $row = $rdb->where($map)->find();
        $thisRow = $rdb->prepare($row);
        $this->assigns['dataWeb'] = $thisRow;
        
        if($row){
            $map = [];
            $map['web_id'] = $id;
            $map['mode'] = $thisRow['mode'];
            $map['domain'] = $thisRow['domain'];
            $dataset = [];
            $dataset['web_id'] = $id;
            $dataset['mode'] = $thisRow['mode'];
            $dataset['domain'] = $thisRow['domain'];
            
            $rdb = new \Rdb\WebNotifySettings();
            $row = $rdb->touch($map, $dataset);
            $row = $rdb->prepare($row);
            $this->assigns['dataWebNotifySettings'] = $row;
            
            $rdb = new \Rdb\WebSocialSettings();
            $row = $rdb->touch($map, $dataset);
            $row = $rdb->prepare($row);
            $this->assigns['dataWebSocialSettings'] = $row;
        }
    }

}
