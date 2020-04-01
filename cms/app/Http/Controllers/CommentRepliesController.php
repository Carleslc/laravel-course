<?php

namespace App\Http\Controllers;

use App\CommentReply;
use Auth;
use Illuminate\Http\Request;

class CommentRepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:viewAdmin,App\User', ['except' => 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $replies = CommentReply::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.comments.replies.index', compact('replies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new CommentReply($request->all());
        $comment->author()->associate(Auth::user());
        $comment->save();
        session()->flash('status', 'Reply added. Waiting for approval.');
        return redirect()->back();
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
        if ($request->exists('is_active')) {
            $request->request->set('is_active', $request->is_active == 'true');
        }
        CommentReply::findOrFail($id)->update($request->all());
        return redirect(route('replies.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CommentReply::destroy($id);
        return redirect(route('replies.index'));
    }
}
