<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can memo web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'TopController@index');
Route::get('memo', 'MemoController@index');
Route::get('memo/input', 'MemoController@input');
Route::post('memo/confirm', 'MemoController@confirm');
Route::get('memo/complete', 'MemoController@complete');
Route::get('memo/edit', 'MemoController@edit');
Route::post('memo/complete_edit', 'MemoController@complete_edit');
Route::get('memo/delete', 'MemoController@delete');
Route::get('memo/complete_delete', 'MemoController@complete_delete');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
