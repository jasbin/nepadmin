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

//Route::get('/', 'PostsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::post('posts/store', 'PostsController@store')->name('posts.store');
// Route::post('posts/update','PostsController@update')->name('posts.update');
// Route::post('posts/delete', 'PostsController@delete')->name('posts.delete');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard/posts', 'PostsController@index')->name('posts.index');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post('posts/store', 'PostsController@store')->name('posts.store');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post('posts/update', 'PostsController@update')->name('posts.update');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::post('posts/delete', 'PostsController@delete')->name('posts.delete');
});

//logout
Route::get('logout', 'AdminController@logout')->name('logout');
