<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
use Gate;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->expectsJson() || $request->has('raw')) {
            return Post::withTrashed()->get();
        }
        return view('posts.index')->with('posts', Post::all())->with('archive', Post::onlyTrashed()->latest()->get());
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

        // $user = User::findOrFail($userId);
        // $user->posts()->create($request->all());
        // return redirect('/posts');

        // Included in PostRequest:
        // $this->validate($request, [
        //     'title' => 'required|max:50',
        //     'content' => 'required'
        // ]);

        $post = new Post($request->all());
        $this->setHeaderImage($request, $post);
        $post->user()->associate(Auth::user());
        $post->save();
        return redirect('/posts/' . $post->id);
    }

    private function setHeaderImage(PostRequest $request, Post $post) {
        $header = $request->file('header');
        if ($header) {
            $name = $header->getClientOriginalName();
            $header->move('images', $name);
            $post->header = $name;
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
        // return "Post" . $id;
        // return view('post')->with('id', $id);
        // $post = DB::select('SELECT * FROM posts WHERE id = ?', [$id]);
        // $post = Post::where('id', $id);
        $post = Post::withTrashed()->findOrFail($id);
        $owner = User::find($post->user_id);
        return view('posts.show', compact('post', 'owner'));
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
        Gate::authorize('update', $post); # PostPolicy::update with current logged in user
        return view('posts.edit', compact('post'));
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
        $post = Post::findOrFail($id);
        Gate::authorize('update', $post);
        $this->setHeaderImage($request, $post);
        $post->update($request->except('header'));
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
        Gate::authorize('update', $post);

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
        Gate::authorize('update', $post);

        $post->restore();
        return redirect('/posts/' . $post->id);
    }
}
