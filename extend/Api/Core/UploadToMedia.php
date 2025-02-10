<?php
/*
\Api\Core\UploadToMedia
*/
namespace Api\Core;

class UploadToMedia extends \Api\Upload
{
    public function doProcess()
    {
        if(empty($this->user)){ throw new \Exception('沒有上傳者資訊'); }
        
        //-----
        $params = $this->params;
        $dir_path = $this->params['dir_path']??'';
        $dir_path = ($dir_path)?$dir_path:\Upload\Config::$dir_paths['media'];
        // $service = new \Upload\Local\Uploader();
        // $service = new \Upload\Cloud\Uploader();
        $service = new \Upload\Uploader();
        $service->init($params);
        $service->setUser($this->user);
        $service->setController($this->controller);
        $service->setDirPath($dir_path);
        $result = $service->doProcess();
        
        //-----
        $this->result = $this->doUpdate($result);
        return $this->result;
    }  
    
    public function doUpdate($result = [])
    {
        //-----
        $web_id = \Web::id();
        
        //-----
        $identity = $result['identity']??'';
        $dir_path = $result['dir_path']??'';
        $title = $result['title']??'';
        $file_path = $result['file_path']??'';
        $file_name = $result['file_name']??'';
        $file_size = $result['file_size']??'';
        $file_type = $result['file_type']??'';
        $file_ext = $result['file_ext']??'';
        $upload_way = $result['upload_way']??'';
        $log_upload_id = $result['log_upload_id']??'';
        $remote_asset_id = $result['asset_id']??'';
        $remote_public_id = $result['public_id']??'';
        $remote_unique_id = $result['unique_id']??'';
        $remote_bytes = $result['bytes']??'';
        $width = $result['width']??'';
        $height = $result['height']??'';
        if(empty($file_path)){ throw new \Exception('檔案資訊錯誤'); }
        if(empty($file_name)){ throw new \Exception('沒有上傳結果'); }
        if(empty($file_size)){ throw new \Exception('檔案大小錯誤'); }
        
        //-----
        $id = $this->params['id']??'';
        $tag_file = $this->params['tag_file']??'';
        $ref_type = $this->params['ref_type']??'';
        $category = $this->params['category']??'';
        $type = $this->params['type']??'';
        $field = $this->params['field']??'';
        $media_dir_id = $this->params['media_dir_id']??'';
        $media_dir_ids = $this->params['media_dir_ids']??'';
        
        //-----
        $upload_location = $this->params['upload_location']??'';
        if($upload_location == 'system'){
            $type = $this->params['type']??'Media-path';
            $ref_type = $this->params['ref_type']??'Media';
            $category = $this->params['category']??'Media';
            $field = $this->params['field']??'path';
        }else if($upload_location == 'category'){
            $category = $this->params['category']??'';
        }else if($upload_location == 'dirs'){
            $type = $this->params['type']??'Media-path';
            $ref_type = $this->params['ref_type']??'Media';
            $category = $this->params['category']??'Media';
            $field = $this->params['field']??'path';
            $media_dir_id = $this->params['media_dir_id']??'';
            $media_dir_ids = $media_dir_id;
        }else{
        }
        
        //-----本地端用不同檔名
        $rdb = new \Rdb\Media();
        $dataset = array();
        $dataset['upload_way'] = $upload_way;
        $dataset['log_upload_id'] = $log_upload_id;
        $dataset['remote_asset_id'] = $remote_asset_id;
        $dataset['remote_public_id'] = $remote_public_id;
        $dataset['remote_unique_id'] = $remote_unique_id;
        $dataset['remote_bytes'] = $remote_bytes;
        $dataset['width'] = $width;
        $dataset['height'] = $height;
        $dataset['web_id'] = $web_id;
        $dataset['ref_id'] = $id;
        $dataset['ref_type'] = $ref_type;
        $dataset['user_id'] = $this->user['id'];
        $dataset['role_id'] = $this->user['role_id'];
        $dataset['role_type'] = $this->user['role_type'];
        $dataset['type'] = $type;
        $dataset['category'] = $category;
        $dataset['media_dir_id'] = $media_dir_id;
        $dataset['media_dir_ids'] = $media_dir_ids;
        $dataset['tag_file'] = $tag_file;
        $dataset['field'] = $field;
        $dataset['path'] = $file_path;
        $dataset['title'] = $title;
        $dataset['dir_path'] = $dir_path;
        $dataset['file_name'] = $file_name;
        $dataset['file_size'] = $file_size;
        $dataset['file_type'] = $file_type;
        $dataset['file_ext'] = $file_ext;
        $media_id = $rdb->add2($dataset);
        
        //-----更新資訊
        if($field && $id){
            $map = array();
            $map['web_id'] = $web_id;
            $map['id'] = $id;
            $dataset = array();
            $dataset[$field] = $file_path;
            $aff = $this->rdb->where($map)->save($dataset);
        }
        
        //-----輸出結果
        $result = [];
        $result['identity'] = $identity;
        $result['ref_id'] = $id;
        $result['ref_type'] = $ref_type;
        $result['user_id'] = $this->user['id'];
        $result['role_id'] = $this->user['role_id'];
        $result['role_type'] = $this->user['role_type'];
        $result['media_id'] = $media_id;
        $result['path'] = $file_path;
        $result['title'] = $title;
        $result['file_name'] = $file_name;
        $result['file_size'] = $file_size;
        $result['file_type'] = $file_type;
        $result['file_ext'] = $file_ext;
        return $result;
    }
}