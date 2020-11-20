<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//跳转登录界面
Route::get('/', function () {return view('home/login');});

Route::get('noaccess','Admin\AdminController@noaccess');

Route::group(['prefix'=>'admin','namespace'=>'Admin',],function (){
    //跳转后台用户登录界面
    Route::get('login','AdminController@login');
    //验证
    Route::post('captcha','AdminController@captcha')->name('captcha');

});
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['HasRole','IsLogin']],function (){

    //跳转后台首页
    Route::get('index','AdminController@index')->name('index');
    //后台退出登录路由
    Route::get('logout','AdminController@logout')->name('logout');
  //后台系统首页
    Route::get('welcome','AdminController@welcome')->name('welcome');
    //跳转log页面
    Route::get('log','AdminController@log');

    //后台用户模块相关路由
    Route::get('user/auth/{id}','UserController@auth');
    Route::post('user/doAuth','UserController@doAuth');
    Route::get('user/del','UserController@delAll');
    Route::resource('user','UserController');
    //病人模块管理路由   患者不设立删除功能，数据不易
    Route::get('patient/del','PatientController@delAll');
    Route::resource('patient','PatientController');
    //角色模块
    //角色授权路由
    //Route::get('role/del','RoleController@delAll');
    Route::get('role/auth/{id}','RoleController@auth');
    Route::post('role/doAuth','RoleController@doAuth');
    Route::get('role/del','RoleController@delAll');
    Route::resource('role','RoleController');

    //权限模块路由        资源模块方法要在根路由前面
    Route::get('permission/del','PermissionController@delAll');
    Route::resource('permission','PermissionController');
    //药品模块管理路由
    Route::get('drugst/del','DrugstController@delAll');
    Route::resource('drugst','DrugstController');

});
Route::group(['prefix'=>'home','namespace'=>'Home'],function (){
    //验证码
    Route::post('captcha','HomeController@captcha');
    //跳转首页
    Route::get('index','HomeController@index')->name('index');
    //跳转个人信息界面
    Route::get('info','HomeController@info')->name('info');
    //修改个人信息
    Route::get('update','HomeController@update')->name('update');
    //后台退出登录路由
    Route::get('logout','HomeController@logout')->name('logout');
    //
    //跳转病人诊疗模块

    Route::get('druglist','HomeController@querydrug');
    Route::post('tcmform/chaxun','TcmformController@chaxun');
    Route::post('tcmform/drugstpd','TcmformController@drugstpd');
    Route::resource('tcmform','TcmformController');


   //跳转诊疗记录模块
    Route::post('patient/record','PatientController@record');
    Route::resource('patient','PatientController');


    //跳转医案库模块
    Route::post('record/record','RecordController@record');
    Route::resource('record','RecordController');


    //跳转医中药库模块
    Route::resource('drugstku','DrugstkuController');

});



