<?php

use Illuminate\Support\Facades\Route;

Route::group(['domain' => 'm.zaixixian.com'], function(){
    Route::get('/', 'HomeController@index');
    Route::get('/post/{post}', 'PostController@show');
    Route::get('/post/views/{post}', 'PostController@views');
    Route::get('/post/phone/{post}', 'PostController@phone');

    Route::get('/fenlei/{name}', 'CategoryController@fenlei');
    Route::get('/category/{category}', 'CategoryController@index');
});