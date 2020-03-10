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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gate;

Route::get('/', function () {
    return redirect('/posts');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/about', function () {
    $links = [
        '@Carleslc' => "https://github.com/Carleslc/",
        'Source (GitHub)' => "https://github.com/Carleslc/laravel-course"
    ];
    return view('about', compact('links'));
});

## Auth

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

## Users

Route::get('users', function () {
    return User::all();
})->middleware('auth', 'can:viewAny,App\User');

Route::get('users/{user}', function (User $user) {
    return $user->load('address')->load('roles');
})->middleware('auth', 'can:view,user')->name('users.show');

Route::get('/users/{user}/address', function (User $user) {
    return $user->address;
})->middleware('auth', 'can:view,user');

Route::get('/test', function () {
    $user = User::where('name', 'Test')->first();
    if (!$user) {
        $user = User::create(['name' => 'Test', 'email' => 'test@example.com', 'password' => 'test']);
        $user->address()->create(['street' => 'Test Street', 'number' => '1', 'city' => 'NY', 'country' => 'USA']);
        $user->roles()->create(['name' => 'test']);
    }
    return redirect(route('users.show', $user->id));
})->middleware('auth', 'can:viewAny,App\User');

## Posts

Route::resource('posts', 'PostController');

Route::post('/posts/{post}/restore', 'PostController@restore')->name('posts.restore');

Route::get('/users/{user}/posts', function (User $user) {
    return $user->posts;
});

## Roles

Route::get('/roles', function () {
    return Role::all();
});

Route::get('/users/{user}/roles', function (User $user) {
    foreach ($user->roles as $role) {
        echo $role->name . '</br>';
    }
});

Route::get('/roles/{role}/users', function(Role $role) {
    foreach ($role->users as $user) {
        echo $user->name . '</br>';
    }
});

## Dates

Route::get('/dates', function(Request $request) {
    $echoDump = function ($label, $echo, $dump) use ($request) {
        echo nl2br("<b>" . $label . "</b>: " . $echo . "\n");
        if ($request->has('dump')) {
            dump($dump);
        }
    };

    $dumpVar = function ($label, $var) use ($echoDump) {
        $echoDump($label, $var, $var);
    };

    $dumpDate = function ($label, DateTime $date, $format='d-m-Y') use ($echoDump) {
        $echoDump($label, $date->format($format), $date);
    };

    $dumpDateHuman = function ($label, Carbon $date) use ($echoDump) {
        $echoDump($label, $date->diffForHumans(), $date);
    };

    $dumpDate('Today', new DateTime());
    $dumpDate('+1 week', new DateTime('+1 week'));

    $dumpVar('Now', Carbon::now());
    $dumpDateHuman('Yesterday', Carbon::now()->yesterday());
    $dumpDateHuman('+1 week', Carbon::now()->addWeek());
    $dumpDateHuman('-5 months', Carbon::now()->subMonths(5));
});

/*

    Route::resource('admin/users', 'AdminUsersController', [
        'names' => [
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            // ...
        ]
    ]);

*/
