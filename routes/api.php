<?php

use Illuminate\Http\Request;
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

Route::group(['prefix' => 'api', 'middleware' => 'api', 'namespace' => 'Api'], function () {
    Route::get('/weixin', 'WeixinController@check');
    Route::post('/weixin', 'WeixinController@handle');
    Route::get('/ip2local/{ip}', 'HelperController@getIpLocal');

    Route::get('/feedback', 'FeedbackController@check');
    Route::post('/feedback', 'FeedbackController@handle');

    Route::post('/weixin/payment', 'WeixinPaymentController@handle');

    Route::get('wechat', 'WechatController@check');
    Route::post('wechat', 'WechatController@handle');
});

Route::group(['prefix' => 'wx/api', 'namespace' => 'WeixinApi'], function () {
    Route::get('config', 'ConfigController@index');
    Route::get('posts', 'PostController@index');
    Route::get('post/{id}', 'PostController@show');
    Route::get('category/{id}/posts', 'CategoryPostController@index');
    Route::get('login', 'UserController@login');
    Route::post('upload', 'ImageController@upload');
    Route::post('post/create', 'PostController@create');
    Route::get('user/posts', 'UserPostController@index');
    Route::post('user/post/{id}/{action}', 'UserPostController@update');
});

Route::group(['prefix' => 'wx/api', 'namespace' => 'WeixinApi'], function () {
    Route::get('topics', 'TopicController@index');
    Route::get('topic/{topic}', 'TopicController@show');
});