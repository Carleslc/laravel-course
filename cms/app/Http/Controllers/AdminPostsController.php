<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\StorageHelper;
use App\Http\Requests\PostRequest;
use App\Post;
use Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $categories = Category::pluck('name');
        $comments = $post->comments->where('is_active', true);
        if (!Auth::check()) {
            session()->put('redirectTo', url()->current());
        }
        return view('post', compact('post', 'categories', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategories();
        return view('admin.posts.create', compact('categories'));
    }

    private function getCategories() {
        $categories = Category::pluck('name', 'id');
        $categories->prepend('', 0);
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        if ($request->category_id == 0) {
            $request->request->set('category_id', null);
        }
        $post = new Post($request->except('header'));
        $post->author()->associate(Auth::user());
        $post->save();
        StorageHelper::saveImage($request, 'header', 'headers', $post->id);
        return redirect(route('posts.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = $this->getCategories();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        if ($request->category_id == 0) {
            $request->request->set('category_id', null);
        }
        $post = Post::findOrFail($id);
        $post->update($request->except('header'));
        StorageHelper::saveImage($request, 'header', 'headers', $id);
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        StorageHelper::deleteImage('headers', $id);
        session()->flash('status', "Post $id deleted");
        return redirect(route('posts.index'));
    }
}
