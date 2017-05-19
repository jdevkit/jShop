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

Route::get('/',[
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

Route::group([
    'prefix' => '/admin',
    'middleware' => ['role:owner|admin']
], function () {

    Route::get('/',[
        'uses' => 'admin\AdminController@index',
        'as' => 'admin.index'
    ]);

    Route::get('/users',[
        'uses' => 'admin\AdminController@showUsers',
        'as' => 'admin.users'
    ]);

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
