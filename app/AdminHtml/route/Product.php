<?php
/*
route目录下的任何路由定义文件都是有效的，分开多个路由定义文件并没有实际的意义，纯粹出于管理方便而已。默认的路由定义文件是route.php，但你完全可以更改文件名，或者添加多个路由定义文件。
index   GET     product            index
create  GET     product/create     create
save    POST    product            save
read    GET     product/:id        read
edit    GET     product/:id/edit   edit
update  PUT     product/:id        update
delete  DELETE  product/:id        delete
@參考及拆解
https://doc.thinkphp.cn/v8_0/resource_route.html
*/
use think\facade\Route;
// Route::get('product/create','product/create');
// Route::post('product','product/save');
// Route::get('product/:id/edit','product/edit'); //優先於product/read
// Route::get('product/:id','product/Read');
// Route::put('product/:id','product/update');
// Route::delete('product/:id','product/delete');

// Route::get('product','product/ReadList');



Route::get('ClientApi/ActiveAccount/:token', 'ClientApi/ActiveAccount');
Route::get('ClientApi/testActiveAccount/:token', 'ClientApi/testActiveAccount');

// Route::get('ClientApi/:action/:id', 'ClientApi/:action');
