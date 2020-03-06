<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::withTrashed()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $userId)
    {
        // DB::insert('INSERT INTO posts(title, content) VALUES (?, ?)', ["My title", "The content"]);

        // $post = new Post;
        // $post->title = "My title";
        // $post->content = "The content";
        // $post->save();

        // Post::create(['title' => 'new title', 'content' => 'my content']);

        $user = User::findOrFail($userId);
        $user->posts()->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return "Post" . $id;
        // return view('post')->with('id', $id);
        // $post = DB::select('SELECT * FROM posts WHERE id = ?', [$id]);
        // $post = Post::where('id', $id);
        $post = Post::withTrashed()->findOrFail($id);
        if ($post->trashed()) {
            return 'Archived';
        }
        return view('post', compact('id', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // Post::find($id)->update(['title' => 'new title', 'content' => 'my content']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Post::find($id)->delete();
        // Post::destroy($id);
        // Post::onlyTrashed()->get()->restore();
        // Post::onlyTrashed()->get()->forceDelete();
    }
}
