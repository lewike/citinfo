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

// Route::group(['prefix' => 'market', 'middleware' => ['wechat.mock'], 'namespace' => 'Market'], function () {

//     Route::get('/', 'HomeController@index');
//     Route::get('/orders', 'HomeController@orders');
//     Route::get('/single/{id}', 'SingleController@show');
//     Route::post('/single/buy', 'SingleController@buy');
//     Route::get('/single/{id}/share', 'SingleController@share');
// });

Route::group(['prefix' => 'admin/market', 'middleware' => ['admin'], 'namespace' => 'Admin\Market'], function () {
    Route::get('/single', 'SingleController@index');
});

Route::group(['prefix' => 'admin','namespace' => 'Admin'], function () {

    Route::get('/login', 'AuthController@login')->name('admin.login');
    Route::post('/login', 'AuthController@loginAuth');

    Route::group(['middleware' => ['admin']], function() {
        Route::get('/', 'HomeController@index');
        Route::get('/post', 'PostController@index');
        Route::get('/post/create', 'PostController@create')->name('admin.post.create');
        Route::post('/post/create', 'PostController@store');
        Route::get('/post/edit/{post}', 'PostController@edit');
        Route::post('/post/edit/{post}', 'PostController@update');
        
        Route::post('/image/upload', 'ImageController@upload');
        
        Route::get('/cate', 'CategoryController@index');
        Route::get('/cate/create', 'CategoryController@create')->name('admin.cate.create');
        Route::post('/cate/create', 'CategoryController@store');

        Route::get('/user', 'UserController@index');

        Route::group(['namespace' => 'Wed'], function () {
            Route::get('/wed/member', 'MemberController@index')->name('admin.wed.member');
            Route::get('/wed/member/create', 'MemberController@create')->name('admin.wed.member.create');
            Route::post('/wed/member/create', 'MemberController@store');
            Route::get('/wed/member/edit/{wed_member}', 'MemberController@edit');
            Route::post('/wed/member/edit/{wed_member}', 'MemberController@update');

            Route::get('wed/config', 'ConfigController@edit');
            Route::post('wed/config', 'ConfigController@update');
        });
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
    
    Route::get('/about', 'PageController@about');
    Route::get('/changelog', 'PageController@changelog');
    Route::get('/contact', 'PageController@contact');
    Route::get('/help', 'PageController@help');
    Route::get('/policy', 'PageController@policy');
    Route::get('/promotion', 'PageController@promotion');
    Route::get('/search', 'SearchController@index');

    Route::post('/image/upload', 'ImageController@upload');

    Route::get('/wed', 'WedController@index');
    Route::get('/wed/list/{page}', 'WedController@list');
    Route::get('/wed/profile', 'WedController@profile');
    
    Route::get('wechat/qrcode', 'WechatController@qrcode');
    Route::get('wechat/check', 'WechatController@check');
});
