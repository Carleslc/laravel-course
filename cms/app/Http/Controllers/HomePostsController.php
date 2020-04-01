<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class HomePostsController extends Controller
{
    public function index() {
        $categories = Category::pluck('name');
        return view('posts', compact('categories'));
    }
}
