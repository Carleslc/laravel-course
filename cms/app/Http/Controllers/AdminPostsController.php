<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use App\User;
//use App\Category;
use Auth;
use Illuminate\Http\Request;
use Storage;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
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
        return ['','ONE','TWO'];
        /*$categories = Category::pluck('name', 'id')->all();
        array_unshift($categories, ''); // prepend
        return $categories;*/
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
        $this->saveHeader($request, $post);
        return redirect(route('posts.index'));
    }

    private function saveHeader(Request $request, Post $post) {
        $header = $request->file('header');
        if ($header) {
            $header->storeAs('headers', $post->id, 'public');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.posts.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->category_id == 0) {
            $request->request->set('category_id', null);
        }
        $post = Post::findOrFail($id);
        $post->update($request->except('header'));
        $this->saveHeader($request, $post);
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
        Storage::disk('public')->delete('headers/' . $id);
        session()->flash('status', "Post {$id} deleted");
        return redirect(route('posts.index'));
    }
}
