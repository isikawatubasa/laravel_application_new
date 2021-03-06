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
// Route::get('/', function () {     //課題7コメントアウト
//     return view('welcome');       //課題7コメントアウト
// });                               //課題7コメントアウト

Route::get('sample', 'SampleController@index')->name('sample');
Auth::routes();                                             //課題6追加
Route::get('/home', 'HomeController@index')->name('home');  //課題6追加

Route::group(['middleware' => 'auth'], function () {                         //課題7追加
    Route::get('/', 'PostController@index')->name('post.index');             //課題7追加
    Route::get('post/create', 'PostController@create')->name('post.create'); //課題7追加
    Route::post('post/create', 'PostController@store')->name('post.store');  //課題7追加
    Route::get('post/{id}/show', 'PostController@show')->name('post.show');  //課題8追加
    Route::get('post/{id}/edit', 'PostController@edit')->name('post.edit');  //課題9追加
    Route::post('post/{id}/update', 'PostController@update')->name('post.update');//課題9追加
    Route::get('post/{id}/delete', 'PostController@delete')->name('post.delete');//課題10追加
    //Route::get('/hello', 'HelloController@index')->name('hello');   //課題11
});



