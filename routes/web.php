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
        'uses' => 'admin\UsersController@index',
        'as' => 'admin.users'
    ]);

    Route::get('/user/{id}',[
        'uses' => 'admin\UsersController@editUser',
        'as' => 'admin.users.edit'
    ]);

    Route::put('/user/{id}/update',[
        'uses' => 'admin\UsersController@updateUser',
        'as' => 'admin.users.update'
    ]);

    Route::post('/user/{id}/roles',[
        'uses' => 'admin\UsersController@updateRoles',
        'as' => 'admin.users.roles'
    ]);

    Route::get('/user/{id}/delete',[
        'uses' => 'admin\UsersController@deleteUser',
        'as' => 'admin.users.delete'
    ]);

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
