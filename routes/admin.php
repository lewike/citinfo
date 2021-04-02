<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'AuthController@login')->name('admin.login');
Route::post('/login', 'AuthController@loginAuth');

Route::group(['middleware' => ['admin']], function() {
    Route::get('/', 'HomeController@index');

    Route::get('/post', 'PostController@index');
    Route::get('/post/create', 'PostController@create')->name('admin.post.create');
    Route::post('/post/create', 'PostController@store');
    Route::get('/post/edit/{post}', 'PostController@edit');
    Route::post('/post/edit/{post}', 'PostController@update');
    Route::post('/post/delete', 'PostController@delete');
    Route::get('/post/phone-info/{phone}', 'PostController@phoneInfo');
    
    Route::post('/image/upload', 'ImageController@upload');
    
    Route::get('/cate', 'CategoryController@index');
    Route::get('/cate/create', 'CategoryController@create')->name('admin.cate.create');
    Route::post('/cate/create', 'CategoryController@store');

    Route::get('/user', 'UserController@index');

    Route::get('mp/config/menu', 'MpController@configMenu');
    Route::post('mp/config/menu', 'MpController@updateConfigMenu');
    Route::get('mp/config/common', 'MpController@configCommon');
    Route::post('mp/config/common', 'MpController@updateConfigCommon');

    Route::group(['namespace' => 'Wed'], function () {
        Route::get('/wed/member', 'MemberController@index')->name('admin.wed.member');
        Route::get('/wed/member/create', 'MemberController@create')->name('admin.wed.member.create');
        Route::post('/wed/member/create', 'MemberController@store');
        Route::get('/wed/member/edit/{wed_member}', 'MemberController@edit');
        Route::post('/wed/member/edit/{wed_member}', 'MemberController@update');

        Route::get('/wed/config', 'ConfigController@edit');
        Route::post('/wed/config', 'ConfigController@update');
        
        Route::get('/wed/notice', 'NoticeController@index');
    });

    Route::group(['namespace' => 'Carpool'], function () {
        Route::get('pinche/info', 'InfoController@index');
        Route::get('pinche/info/create', 'InfoController@create');
        Route::post('pinche/info/create', 'InfoController@save');
        Route::post('pinche/info/delete', 'InfoController@delete');
        Route::get('pinche/consume', 'ConsumeController@index');
        Route::get('pinche/recharge', 'RechargeController@index');
        Route::get('pinche/config', 'ConfigController@edit');            
        Route::post('pinche/config', 'ConfigController@update');            
    });

    Route::group(['namespace' => 'Website', 'prefix' => 'website'], function () {
        Route::get('/config', 'ConfigController@edit');
        Route::post('/config', 'ConfigController@update');

        Route::get('/ad', 'AdController@edit');
        Route::post('/ad', 'AdController@update');
    });
});