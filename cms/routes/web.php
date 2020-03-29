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

Route::get('/', function() {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts/{slug}', 'AdminPostsController@show')->name('posts.show');

Route::group(['middleware' => ['auth', 'can:viewAdmin,App\User']], function() {
    Route::get('/admin', function() {
        return view('admin.index');
    })->name('admin');

    Route::resource('admin/users', 'AdminUsersController')->except('show');

    Route::resource('admin/posts', 'AdminPostsController')->except('show');

    Route::resource('admin/categories', 'AdminCategoriesController')->except(['show', 'edit', 'update']);

    Route::resource('admin/media', 'AdminMediaController')->only(['index', 'create', 'store']);
    Route::delete('admin/media', 'AdminMediaController@destroy');
});

Route::group(['middleware' => 'auth'], function() {
    Route::resource('admin/comments', 'CommentsController')->except(['show', 'create', 'edit']);
    Route::resource('admin/comments/replies', 'CommentRepliesController')->except(['show', 'create', 'edit']);
});
