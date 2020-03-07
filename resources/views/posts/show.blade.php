@extends('layouts.app')

@section('content')
<h2>(#{{$post->id}}) {{$post->title}}</h2>
<p>{{$post->content}}</p>
<hr>
@if ($post->trashed())
    <p>This post is archived.</p>
    <form method="post" action="/posts/{{$post->id}}/restore">
        @csrf
        <input type="submit" value="Restore">
    </form>
@else
    <button type="button" onclick="window.location='{{route('posts.edit', $post->id)}}'">Edit</button><br>
@endif
<br>
<form method="post" action="/posts/{{$post->id}}">
    @csrf
    {{ method_field('DELETE') }}
    <input type="submit" value="{{ $post->trashed() ? "Delete" : "Archive" }}">
</form>
@endsection
