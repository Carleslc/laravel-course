<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;

class HomePostsController extends Controller
{
    public function index() {
        $posts = Post::paginate(3);
        return view('posts', compact('posts'));
    }

    public function indexByCategory(String $categoryName) {
        $category = Category::where('name', $categoryName)->firstOrFail();
        $posts = Post::where('category_id', $category->id)->paginate(3);
        return view('posts', compact('posts'))->with('header', $categoryName);
    }

    public function indexByAuthor(String $authorName) {
        $user = User::where('name', $authorName)->firstOrFail();
        $posts = Post::where('user_id', $user->id)->paginate(3);
        return view('posts', compact('posts'))->with('header', $authorName);
    }
}
