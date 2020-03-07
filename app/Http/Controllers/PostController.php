<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
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
    public function index(Request $request)
    {
        if ($request->has('raw')) {
            return Post::withTrashed()->get();
        }
        return view('posts.index')->with('posts', Post::all())->with('archive', Post::onlyTrashed()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // DB::insert('INSERT INTO posts(title, content) VALUES (?, ?)', ["My title", "The content"]);

        // $post = new Post;
        // $post->title = "My title";
        // $post->content = "The content";
        // $post->save();

        // Post::create(['title' => 'new title', 'content' => 'my content']);

        // $user = User::findOrFail($userId);
        // $user->posts()->create($request->all());
        // return redirect('/posts');

        // Included in PostRequest:
        // $this->validate($request, [
        //     'title' => 'required|max:50',
        //     'content' => 'required'
        // ]);

        $post = new Post($request->all());
        $post->user()->associate(User::findOrFail(1));
        $post->save();
        return redirect('/posts/' . $post->id);
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
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
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
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return redirect('/posts/' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Post::destroy($id);
        // Post::onlyTrashed()->get()->restore();
        $post = Post::withTrashed()->findOrFail($id);
        if ($post->trashed()) {
            $post->forceDelete();
            return redirect('/posts');
        } else {
            $post->delete();
            return redirect('/posts/' . $post->id);
        }
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect('/posts/' . $post->id);
    }
}
