<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;

class HomePostsController extends Controller
{
    public function index() {
        return $this->showPosts(Post::paginate(3));
    }

    public function indexByCategory(String $categoryName) {
        $category = Category::where('name', $categoryName)->firstOrFail();
        $posts = Post::where('category_id', $category->id)->paginate(3);
        return $this->showPosts($posts, $categoryName);
    }

    private function showPosts($posts, $header = 'Posts') {
        $categories = Category::pluck('name');
        return view('posts', compact('categories', 'posts', 'header'));
    }
}
