<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Auth;

class HomePostsController extends Controller
{
    public function index() {
        $categories = Category::pluck('name');
        $posts = Post::paginate(3);
        if (!Auth::check()) {
            session()->put('redirectTo', url()->current());
        }
        return view('posts', compact('categories', 'posts'));
    }
}
