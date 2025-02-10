<?php

namespace app\AdminApi\controller;
use app\AdminApi\common\BaseController;

class Activities extends BaseController
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/Add
    */
    public function Add()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\Add();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/Edit
    */
    public function Edit()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\Edit();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/EditQa
    */
    public function EditQa()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\EditQa();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/EditExchangeGift
    */
    public function EditExchangeGift()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\EditExchangeGift();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/EditLotteries
    */
    public function EditLotteries()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\EditLotteries();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/StatusEnable
    */
    public function StatusEnable()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\StatusEnable();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/Remove
    */
    public function Remove()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\Remove();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/Sort
    */
    public function Sort()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\Sort();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/EditSwitch
    */
    public function EditSwitch()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\EditSwitch();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/RefreshTotal
    */
    public function RefreshTotal()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\RefreshTotal();
            $service->init($this->params);
            $response = $service->doProcess();
            $this->apiSuccess($response);
        }catch(\Exception $e){
            $this->apiError($e);
        }
    }
    /*
    @test
    https://demo2.app/AdminApi/Activities/ExportExcel
    */
    public function ExportExcel()
    {        
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\ExportExcel();
            $service->init($this->params);
            $service->doProcess();
            $service->download();
            exit;
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/ExportExcelForUsers
    */
    public function ExportExcelForUsers()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\ExportExcelForUsers();
            $service->init($this->params);
            $service->doProcess();
            $service->download();
            exit;
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/ExportExcelForUsersWithCollectSuccess
    */
    public function ExportExcelForUsersWithCollectSuccess()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\ExportExcelForUsersWithCollectSuccess();
            $service->init($this->params);
            $service->doProcess();
            $service->download();
            exit;
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/ExportExcelForUsersWithQaSuccess
    */
    public function ExportExcelForUsersWithQaSuccess()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\ExportExcelForUsersWithQaSuccess();
            $service->init($this->params);
            $service->doProcess();
            $service->download();
            exit;
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/ExportExcelForUsersWithExchangeSuccess
    */
    public function ExportExcelForUsersWithExchangeSuccess()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\ExportExcelForUsersWithExchangeSuccess();
            $service->init($this->params);
            $service->doProcess();
            $service->download();
            exit;
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/ExportExcelForUsersWithAllSuccess
    */
    public function ExportExcelForUsersWithAllSuccess()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\ExportExcelForUsersWithAllSuccess();
            $service->init($this->params);
            $service->doProcess();
            $service->download();
            exit;
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/ExportExcelForQaAnswers
    */
    public function ExportExcelForQaAnswers()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\ExportExcelForQaAnswers();
            $service->init($this->params);
            $service->doProcess();
            $service->removeDefaultSheet();
            $service->focusFirstSheet();
            $service->download();
            exit;
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/ExportExcelForUsersWithJoinLotteryMatch
    */
    public function ExportExcelForUsersWithJoinLotteryMatch()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\ExportExcelForUsersWithJoinLotteryMatch();
            $service->init($this->params);
            $service->doProcess();
            $service->download();
            exit;
        }catch(\Exception $e){
        }
    }
    
    /*
    @test
    https://demo2.app/AdminApi/Activities/ExportExcelForUsersWithWinLotteryMatch
    */
    public function ExportExcelForUsersWithWinLotteryMatch()
    {
        try{
            $this->setAction(__FUNCTION__);
            $service = new \AdminApi\Activities\ExportExcelForUsersWithWinLotteryMatch();
            $service->init($this->params);
            $service->doProcess();
            $service->removeDefaultSheet();
            $service->focusFirstSheet();
            $service->download();
            exit;
        }catch(\Exception $e){
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
            
            //-----
            $id = $this->params['id']??'';
            if(empty($id)){ throw new \Exception('NO ID'); }
            
            //-----
            $dir_path = \Upload\Config::$dir_paths['activities'];
            $dir_path .= "/{$id}";
            $this->params['dir_path'] = $dir_path;
            
            //-----
            $this->logBeforeUpload();
            // $service = new \AdminApi\Activities\UploadLocalImage();
            // $service = new \AdminApi\Activities\UploadCloudImage();
            $service = new \AdminApi\Activities\UploadImage();
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
