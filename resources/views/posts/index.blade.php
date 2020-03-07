@extends('layouts.app')

@section('content')
<button type="button" onclick="window.location='{{route('posts.create')}}'">New post</button>
<ul>
    @foreach ($posts as $post)
        <li>
            <a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a>
        </li>
    @endforeach
</ul>
<p>Archived</p>
<ul>
    @foreach ($archive as $post)
        <li>
            <a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a>
        </li>
    @endforeach
</ul>
@endsection
