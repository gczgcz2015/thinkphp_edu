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

// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],

// ];
use think\Route;

Route::post('/code', 'api/LoginController/code');
Route::post('/login', 'api/LoginController/login');
Route::post('/register', 'api/LoginController/register');

Route::put('/teacher', 'api/TeacherController/editInfo');
Route::get('/teacher', 'api/TeacherController/info');
Route::post('/organization', 'api/OrganizationController/create');
Route::get('/organization', 'api/OrganizationController/info');


