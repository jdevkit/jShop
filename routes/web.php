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
        'uses' => 'admin\UsersController@updateUserRoles',
        'as' => 'admin.users.roles'
    ]);

    Route::post('/user/{id}/delete',[
        'uses' => 'admin\UsersController@deleteUser',
        'as' => 'admin.users.delete'
    ]);

    Route::get('/roles',[
        'uses' => 'admin\UsersController@permissions',
        'as' => 'admin.permissions',
        'middleware' => 'permission:edit-permissions'
    ]);

    Route::post('/roles/update',[
        'uses' => 'admin\UsersController@updateRole',
        'as' => 'admin.role.update',
        'middleware' => 'permission:edit-permissions'
    ]);

    Route::get('/roles/get',[
        'uses' => 'admin\UsersController@getPermissions',
        'as' => 'admin.role.update',
        'middleware' => 'permission:edit-permissions'
    ]);

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
    Route::resource('comments', 'admin\CommentsController');

    Route::resource('authors', 'admin\AuthorsController');

    Route::resource('genres', 'admin\GenresController');

    Route::resource('books', 'admin\BooksController');

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/books', 'BooksController@index')->name('books');
