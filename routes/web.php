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

use App\Role;
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

Route::post('/posts/{post}/restore', 'PostController@restore')->name('posts.restore');

Route::get('/users/{id}/address', function($userId) {
    return User::findOrFail($userId)->address;
});

Route::get('/users/{id}/posts', function($userId) {
    return User::findOrFail($userId)->posts;
});

Route::get('/roles', function() {
    return Role::all();
});

Route::get('/users/{id}/roles', function($userId) {
    $user = User::findOrFail($userId);
    foreach ($user->roles as $role) {
        echo $role->name . '</br>';
    }
});

Route::get('/roles/{id}/users', function($id) {
    $role = Role::findOrFail($id);
    foreach ($role->users as $user) {
        echo $user->name . '</br>';
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
