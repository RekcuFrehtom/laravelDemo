<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/vue','VueController@index');


// 
Route::group([],function(){
    Route::get('/','HomeController@index');
    // 栏目
    Route::get('cate/{url}','HomeController@getCate');
    // 文章
    Route::get('post/{url}','HomeController@getPost');
});

// 会员功能
Route::group(['prefix'=>'user','middleware' => ['backurl']],function(){
    // 注册
    Route::get('register','UserController@getRegister');
    Route::post('register','UserController@postRegister');
    // 登陆
    Route::get('login','UserController@getLogin');
    Route::post('login','UserController@postLogin');
});

// 会员功能
Route::group(['prefix'=>'user','middleware' => ['backurl','member']],function(){
    // 注册
    Route::get('center','UserController@getCenter');
    // 退出登陆
    Route::get('logout','UserController@getLogout');
});


// 后台路由
Route::group(['prefix'=>'admin'],function(){
    // 后台管理不用其它，只用登陆，退出
    // Route::auth();
    Route::get('login', 'Admin\PublicController@getLogin');
    Route::post('login', 'Admin\PublicController@postLogin');
    Route::get('logout', 'Admin\PublicController@getLogout');
});
Route::group(['prefix'=>'admin','middleware' => ['auth:admin','rbac','backurl']],function(){
    // Index
    Route::get('index/index', 'Admin\IndexController@getIndex');
    Route::get('index/main', 'Admin\IndexController@getMain');
    Route::get('index/left/{id}', 'Admin\IndexController@getLeft');
    Route::get('index/cache', 'Admin\IndexController@getCache');
    // admin
    Route::get('admin/index', 'Admin\AdminController@getIndex');
    Route::get('admin/add', 'Admin\AdminController@getAdd');
    Route::post('admin/add', 'Admin\AdminController@postAdd');
    Route::post('admin/edit/{id?}', 'Admin\AdminController@postEdit');
    Route::get('admin/edit/{id?}', 'Admin\AdminController@getEdit');
    Route::get('admin/pwd/{id?}', 'Admin\AdminController@getPwd');
    Route::post('admin/pwd/{id?}', 'Admin\AdminController@postPwd');
    Route::get('admin/del/{id?}', 'Admin\AdminController@getDel');
    Route::get('admin/myedit', 'Admin\AdminController@getMyedit');
    Route::post('admin/myedit', 'Admin\AdminController@postMyedit');
    Route::get('admin/mypwd', 'Admin\AdminController@getMypwd');
    Route::post('admin/mypwd', 'Admin\AdminController@postMypwd');
    // role
    Route::get('role/index', 'Admin\RoleController@getIndex');
    Route::get('role/add', 'Admin\RoleController@getAdd');
    Route::post('role/add', 'Admin\RoleController@postAdd');
    Route::get('role/edit/{id?}', 'Admin\RoleController@getEdit');
    Route::post('role/edit/{id?}', 'Admin\RoleController@postEdit');
    Route::get('role/del/{id?}', 'Admin\RoleController@getDel');
    Route::get('role/priv/{id?}', 'Admin\RoleController@getPriv');
    Route::post('role/priv/{id?}', 'Admin\RoleController@postPriv');
    // 部门
    Route::get('section/index', 'Admin\SectionController@getIndex');
    Route::get('section/add', 'Admin\SectionController@getAdd');
    Route::post('section/add', 'Admin\SectionController@postAdd');
    Route::get('section/edit/{id}', 'Admin\SectionController@getEdit');
    Route::post('section/edit/{id}', 'Admin\SectionController@postEdit');
    Route::get('section/del/{id}', 'Admin\SectionController@getDel');
    // menu
    Route::get('menu/index', 'Admin\MenuController@getIndex');
    Route::get('menu/add/{id?}', 'Admin\MenuController@getAdd');
    Route::post('menu/add/{id?}', 'Admin\MenuController@postAdd');
    Route::get('menu/edit/{id}', 'Admin\MenuController@getEdit');
    Route::post('menu/edit/{id}', 'Admin\MenuController@postEdit');
    Route::get('menu/del/{id}', 'Admin\MenuController@getDel');
    // log
    Route::get('log/index', 'Admin\LogController@getIndex');
    Route::get('log/del', 'Admin\LogController@getDel');
    // cate
    Route::get('cate/index', 'Admin\CateController@getIndex');
    Route::get('cate/cache', 'Admin\CateController@getCache');
    Route::get('cate/add/{id?}', 'Admin\CateController@getAdd');
    Route::post('cate/add/{id?}', 'Admin\CateController@postAdd');
    Route::get('cate/edit/{id?}', 'Admin\CateController@getEdit');
    Route::post('cate/edit/{id?}', 'Admin\CateController@postEdit');
    Route::get('cate/del/{id?}', 'Admin\CateController@getDel');
    // attr
    Route::get('attr/index', 'Admin\AttrController@getIndex');
    Route::get('attr/delfile/{id?}', 'Admin\AttrController@getDelfile');
    Route::post('attr/uploadimg', 'Admin\AttrController@postUploadimg');
    // art
    Route::get('art/index', 'Admin\ArtController@getIndex');
    Route::get('art/add/{id?}', 'Admin\ArtController@getAdd');
    Route::post('art/add/{id?}', 'Admin\ArtController@postAdd');
    Route::get('art/edit/{id}', 'Admin\ArtController@getEdit');
    Route::post('art/edit/{id}', 'Admin\ArtController@postEdit');
    Route::get('art/del/{id}', 'Admin\ArtController@getDel');
    Route::get('art/show/{id}', 'Admin\ArtController@getShow');
    Route::post('art/alldel', 'Admin\ArtController@postAlldel');
    Route::post('art/listorder', 'Admin\ArtController@postListorder');
    // database
    Route::get('database/export', 'Admin\DatabaseController@getExport');
    Route::post('database/export', 'Admin\DatabaseController@postExport');
    Route::get('database/import/{pre?}', 'Admin\DatabaseController@getImport');
    Route::post('database/delfile', 'Admin\DatabaseController@postDelfile');
    // type
    Route::get('type/index/{pid?}', 'Admin\TypeController@getIndex');
    Route::get('type/add/{id?}', 'Admin\TypeController@getAdd');
    Route::post('type/add/{id?}', 'Admin\TypeController@postAdd');
    Route::get('type/edit/{id?}', 'Admin\TypeController@getEdit');
    Route::post('type/edit/{id?}', 'Admin\TypeController@postEdit');
    Route::get('type/del/{id?}', 'Admin\TypeController@getDel');
    // 会员组
    Route::get('group/index', 'Admin\GroupController@getIndex');
    Route::get('group/add', 'Admin\GroupController@getAdd');
    Route::post('group/add', 'Admin\GroupController@postAdd');
    Route::get('group/edit/{id}', 'Admin\GroupController@getEdit');
    Route::post('group/edit/{id}', 'Admin\GroupController@postEdit');
    Route::get('group/del/{id}', 'Admin\GroupController@getDel');
    // 会员
    Route::get('user/index', 'Admin\UserController@getIndex');
    Route::get('user/edit/{id}', 'Admin\UserController@getEdit');
    Route::post('user/edit/{id}', 'Admin\UserController@postEdit');
    Route::get('user/status/{id}/{status}', 'Admin\UserController@getStatus');
});
