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

Route::group(['prefix' => 'market', 'middleware' => ['web', 'wechat.mock'], 'namespace' => 'Market'], function () {

    Route::get('/', 'HomeController@index');
    Route::get('/orders', 'HomeController@orders');
    Route::get('/single/{id}', 'SingleController@show');
    Route::post('/single/buy', 'SingleController@buy');
    Route::get('/single/{id}/share', 'SingleController@share');
});

Route::group(['prefix' => 'admin/market', 'middleware' => ['admin'], 'namespace' => 'Admin\Market'], function () {
    Route::get('/single', 'SingleController@index');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/post', 'PostController@index');
    Route::get('/post/create', 'PostController@create')->name('admin.post.create');

    Route::post('/image/upload', 'ImageController@upload');
    
    Route::get('/cate', 'CategoryController@index');
    Route::get('/cate/create', 'CategoryController@create')->name('admin.cate.create');

    Route::get('/wed/member', 'WedController@member');
});

Route::group(['namespace' => 'Website'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/fenlei/{name}', 'CategoryController@fenlei');
    Route::get('/category/{category}', 'CategoryController@index');
    
    Route::get('/post/create', 'PostController@create')->name('website.post.create');
    Route::get('/post/wx/qrcode', 'PostController@qrcode');
    Route::get('/about', 'PageController@about');
    Route::get('/changelog', 'PageController@changelog');
    Route::get('/contact', 'PageController@contact');
    Route::get('/help', 'PageController@help');
    Route::get('/policy', 'PageController@policy');
    Route::get('/promotion', 'PageController@promotion');
    Route::get('/search', 'SearchController@index');

    Route::post('/image/upload', 'ImageController@upload');

    Route::get('/wed', 'WedController@index');
    Route::get('/wed/profile', 'WedController@profile');
});
