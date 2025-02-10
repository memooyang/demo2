<?php
use think\facade\Route;

Route::get('Index/ActiveAccount/:token', 'Index/ActiveAccount');
Route::get('Index/testActiveAccount/:token', 'Index/testActiveAccount');

Route::get('Index/ResetPassword/:token', 'Index/ResetPassword');
Route::get('Index/testResetPassword/:token', 'Index/testResetPassword');

