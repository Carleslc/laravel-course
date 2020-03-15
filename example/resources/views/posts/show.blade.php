@extends('layouts.app')

@section('content')
@if ($post->hasHeader())
    <img id="header" src="{{$post->header}}" alt="Header Image">
@endif
<h2>(#{{$post->id}}) {{$post->title}}</h2>
@if ($owner)
    <i>by <b>{{$owner->name}}</b></i>
@endif
<hr>
<p>{{$post->content}}</p>
<hr>
@if ($post->trashed())
    <i>This post is archived.</i>
@endif
@can('update', $post)
    @if ($post->trashed())
        <form method="post" action="/posts/{{$post->id}}/restore">
            @csrf
            <input type="submit" value="Restore" class="btn btn-success">
        </form>
    @else
        <button type="button" class="btn btn-primary" onclick="window.location='{{route('posts.edit', $post->id)}}'">Edit</button><br>
    @endif
    <form method="post" action="/posts/{{$post->id}}">
        @csrf
        {{ method_field('DELETE') }}
        <input type="submit" class="btn btn-danger" value="{{ $post->trashed() ? "Delete" : "Archive" }}">
    </form>
@endcan
@endsection
