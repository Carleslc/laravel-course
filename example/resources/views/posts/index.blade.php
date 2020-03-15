@extends('layouts.app')

@section('content')
@auth
<button type="button" class="btn btn-primary" style="margin-bottom: 20px" onclick="window.location='{{route('posts.create')}}'">New post</button>
@endauth
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
