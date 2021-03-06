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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/code', "Code@index");
Route::post('/code/database', 'Code@database');
Route::post('/code/table', 'Code@gen');


Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'prefix'=>'admin',
    'namespace'=>'Admin'
], function (){
    Route::any('success',function (){
        return view('admin/success');
    });

    Route::resource('articel', 'articelCtrl');
    //auto_code_gen_flag
});