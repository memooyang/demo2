<?php

namespace app\AdminApi\controller;
use app\AdminApi\common\BaseController;

class Users extends BaseController
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Users/Add
    */
    // public function Add()
    // {
    //     try{
            // $this->setAction(__FUNCTION__);
    //         $service = new \AdminApi\Users\Add();
    //         $service->init($this->params);
    //         $response = $service->doProcess();
    //         $this->apiSuccess($response);
    //     }catch(\Exception $e){
    //         $this->apiError($e);
    //     }
    // }
    
    /*
    @test
    https://demo2.app/AdminApi/Users/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Users\Edit();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Users/EditWithUserProfiles
    */
    public function EditWithUserProfiles()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Users\EditWithUserProfiles();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Users/StatusEnable
    */
    public function StatusEnable()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Users\StatusEnable();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Users/Lock
    */
    public function Lock()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Users\Lock();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Users/Remove
    */
    public function Remove()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Users\Remove();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Users/Sort
    */
    public function Sort()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Users\Sort();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Users/EditSwitch
    */
    public function EditSwitch()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Users\EditSwitch();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Users/EditAvatar
    */
    public function EditAvatar()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Users\EditAvatar();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Users/EditPassword
    */
    public function EditPassword()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Users\EditPassword();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Users/RenewPassword
    */
    public function RenewPassword()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Users\RenewPassword();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Users/ExportExcel
    */
    public function ExportExcel()
    {        
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Users\ExportExcel();
            $service->init($this->params);
            $service->doProcess();
            $service->download();
            exit;
            // $this->apiSuccess($response);
        }catch(\Exception $e){
            // _test($e);
            // $this->apiError($e);
        }
    }
    
    /*
    https://pqina.nl/slim/#jquery-api
    @test
    https://demo2.app/AdminApi/Users/UploadImage
    @file
    {
        "status":"success",
        "name":"uid_filename.jpg",
        "path":"path/uid_filename.jpg"
    }
    */
    public function UploadImage()
    {
        try{
            $this->setAction(__FUNCTION__);
            
            // //-----local
            // // $file = request()->file('avatar');
            // $file = $_FILES['slim_output_0'];
            // // $file_name = $file['tmp_name'];
            // $savename = \think\facade\Filesystem::putFile("uploads/avatar", $file, 'uniqid');
            // $this->apiSuccess($savename);
            
            // $service = new \AdminApi\Users\UploadAvatar();
            // $service = new \AdminApi\Users\UploadCloudAvatar();
            
            //-----
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('NO ID'); }
            $dir_path = \Upload\Config::$dir_paths['avatar'];
            $this->params['dir_path'] = $dir_path;
            
            //-----
            $this->logBeforeUpload();
            // $service = new \AdminApi\Users\UploadLocalAvatar();
            // $service = new \AdminApi\Users\UploadLocalImage();
            // $service = new \AdminApi\Users\UploadCloudImage();
            $service = new \AdminApi\Users\UploadImage();
            $service->init($this->params);
            $service->setUser($this->user);
            $service->setController($this);
            $response = $service->doProcess();
            $this->logAfterUpload($response);
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
}
