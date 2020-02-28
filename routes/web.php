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

Route::get('/about', function () {
    return 'CMS from course at <a href="https://www.udemy.com/course/php-with-laravel-for-beginners-become-a-master-in-laravel/">PHP with Laravel for beginners - Become a Master in Laravel</a>';
});

Route::get('/post/{id}', function ($id) {
    return 'Post #' . $id;
});

Route::get('admin', [
    'as' => 'admin.home',
    function () {
        $url = route('admin.home');
        return $url;
    }
]);

// Route::get('/logout', 'Auth\LoginController@logout');

/*

    Route::resource('admin/users', 'AdminUsersController', [
        'names' => [
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            // ...
        ]
    ]);

*/
