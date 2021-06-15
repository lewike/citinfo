<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')
    ->namespace('Admin')
    ->group(base_path('routes/admin.php'));

Route::group(['namespace' => 'Mobile', 'domain' => 'm.zaixixian.com'], function(){
    Route::get('/', 'HomeController@index');
    Route::get('/post/{post}', 'PostController@show');
    Route::get('/post/views/{post}', 'PostController@views');
    Route::get('/post/phone/{post}', 'PostController@phone');
    Route::get('/post/create', 'PostController@create');

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

Route::group(['namespace' => 'Website'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/fenlei/{name}', 'CategoryController@fenlei');
    Route::get('/category/{category}', 'CategoryController@index');
    
    Route::get('/post/{post}', 'PostController@show')->where('post', '[0-9]+')->name('website.post.show');
    Route::get('/post/create', 'PostController@create')->name('website.post.create');
    Route::get('/post/create/success', 'PostController@success');
    Route::post('/post/create', 'PostController@store');
    Route::get('/post/views/{post}', 'PostController@views');
    Route::post('/post/manage', 'PostController@manage');
    
    Route::get('/about', 'PageController@about');
    Route::get('/changelog', 'PageController@changelog');
    Route::get('/contact', 'PageController@contact');
    Route::get('/help', 'PageController@help');
    Route::get('/policy', 'PageController@policy');
    Route::get('/promotion', 'PageController@promotion');
    Route::get('/search', 'SearchController@index');

    Route::post('/image/upload', 'ImageController@upload');
    
    Route::group(['prefix' => 'wed', 'middleware' => ['wechat.auth']], function () {
        Route::get('/', 'WedController@index');
        Route::get('userinfo/', 'WedController@userInfo');
        Route::post('userinfo/complete', 'WedController@userInfoComplete');
        Route::get('list/{page}', 'WedController@list');
        Route::get('profile', 'Wed\\ProfileController@index');
        Route::get('profile/edit', 'Wed\\ProfileController@edit');
        Route::get('detail/{id}', 'WedController@detail');
        Route::get('activity', 'Wed\\ActivityController@index');
        Route::post('upload', 'Wed\\UploadController@save');
        Route::get('matchmaker', 'MatchMakerController@index');
        
        Route::post('profile/images', 'Wed\\ProfileController@updateImages');
    });
    
    Route::group(['namespace' => 'Weixin', 'prefix' => 'wx'], function(){
        Route::get('/', 'HomeController@index');
        Route::get('/post/show/{post}', 'PostController@show');
        Route::get('/post/view/{post}', 'PostController@view');
        Route::get('post/phone/{id}', 'PostController@phone');
        Route::get('/fenlei/{name}', 'HomeController@fenlei');
        Route::middleware(['wechat.oauth'])->group(function () {
            Route::get('post/create', 'PostController@create');
            Route::post('post/create', 'PostController@store');
            Route::post('post/upload', 'PostController@upload');
            Route::get('user', 'UserController@index');
        });
    });

    Route::get('wechat/qrcode', 'WechatController@qrcode');
    Route::get('wechat/check', 'WechatController@check');
    Route::get('wechat/share', 'WechatController@share');
    
    Route::get('wechat/login', 'WechatController@login');
    Route::group(['middleware' => ['wechat.oauth']], function () {
        Route::get('wechat/auth', 'WechatController@auth');
    });
});

//婚恋交友程序

Route::group(['namespace' => 'Wed', 'prefix' => 'wed'], function(){
    Route::get('/', 'HomeController@index');
    Route::get('/profile', 'ProfileController@index');
    Route::get('/profile/edit', 'ProfileController@edit');
    Route::post('/profile/edit', 'ProfileController@update');

    Route::get('/activity', 'ActivityController@index');
    Route::get('/matchmaker', 'MatchMakerController@index');

    Route::get('/member/{id}', 'MemberController@show');
    
    Route::post('upload', 'UploadController@save');
});

Route::group(['namespace' => 'Carpool', 'prefix' => 'pinche'], function(){
    Route::get('/', 'HomeController@index');
    Route::get('/rule', 'PostController@rule');
    Route::get('/call/{id}', 'HomeController@call')->where('id', '[0-9]+');

    Route::group(['middleware' => 'wechat.mock'], function () {
        Route::get('/post', 'PostController@create');
        Route::post('/post', 'PostController@store');
        Route::get('/show/{id}', 'PostController@show');
        Route::get('/edit/{id}', 'PostController@edit');
        Route::post('/edit/{id}', 'PostController@update');
        Route::get('/del/{id}', 'PostController@delete');
        Route::post('/sticky', 'PostController@sticky');

        Route::post('/recharge', 'HomeController@recharge');
        Route::get('/user', 'HomeController@user');
    });
});
