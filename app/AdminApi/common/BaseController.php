<?php
declare (strict_types = 1);

namespace app\AdminApi\common;

class BaseController extends \app\BaseAdminDashboardController
{
    protected function initialize()
    {
        parent::initialize();
        $this->initAdminByToken();
    }
    
    /*
    @use
    */
    public function TestUpload()
    {
        try{
            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('file');
            
            // 上传到本地服务器
            $savename = \think\facade\Filesystem::putFile("test", $file, 'uniqid');
            $this->apiSuccess($savename);
        }catch(\Exception $e){
        }
    }
}
