<?php

use Illuminate\Support\Facades\Route;

Route::group(['domain' => 'm.zaixixian.com'], function(){
    Route::get('/', 'HomeController@index');
    Route::get('/post/{post}', 'PostController@show');
    Route::get('/post/views/{post}', 'PostController@views');
    Route::get('/post/phone/{post}', 'PostController@phone');
    Route::get('post/create', 'PostController@create');

    Route::get('/fenlei/{name}', 'CategoryController@fenlei');
    Route::get('/category/{category}', 'CategoryController@index');

    Route::prefix('wx')->middleware(['wechat.oauth'])->group(function () {
        Route::get('post/create', 'WechatController@createPost');
        Route::post('post/create', 'WechatController@savePost');
        Route::post('post/upload', 'WechatController@upload');
        Route::post('post/update', 'WechatController@updatePost');
        Route::get('user', 'WechatController@user');
    });
});