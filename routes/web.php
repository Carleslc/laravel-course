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

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    $links = [
        '@Carleslc' => "https://github.com/Carleslc/",
        'Source (GitHub)' => "https://github.com/Carleslc/laravel-course"
    ];
    return view('about', compact('links'));
});

Route::get('admin', [
    'as' => 'admin.home',
    function () {
        $url = route('admin.home');
        return $url;
    }
]);

Route::resource('users', 'UserController');
Route::resource('posts', 'PostController');
Route::resource('users.posts', 'PostController');

Route::get('/users/{id}/roles', function($id) {
    $user = User::findOrFail($id);
    foreach ($user->roles as $role) {
        echo $role->name . '</br>';
    }
});

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
