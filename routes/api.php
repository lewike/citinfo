<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {
    Route::get('wechat', 'WechatController@check');
    Route::post('wechat', 'WechatController@handle');
    
    Route::get('wechat/user', 'WechatController@getUser');

    Route::post('wechat/payment', 'WechatController@payment');
});


Route::group(['namespace' => 'Api', 'domain' => 'hook-api.zaixixian.com'], function(){
    Route::post('msg', 'WechatController@hookMsgc');
    Route::get('task', 'WechatController@task');
});