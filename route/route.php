<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------



Route::get('discuss', 'index/index/discuss');
Route::get('page/:call_sign/:unique_id', 'index/index/page');
Route::get('admin', 'admin/index/index');
Route::post('api/getlog', 'admin/index/getlog');
Route::post('api/uplog', 'admin/index/uplog');
Route::post('api/addlog', 'admin/index/addlog');
Route::get('dellog', 'admin/index/dellog');
Route::get('login', 'admin/login/index');
Route::get('out', 'admin/login/out');
Route::get('index', 'index/index/index');
return [

];
