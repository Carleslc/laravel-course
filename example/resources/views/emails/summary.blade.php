@extends('layouts.email')

@section('content')
<h3>This is your summary for today</h3>
@foreach ($posts as $post)
    <a href="{{route('posts.show', $post->id)}}"><h2>{{$post->title}}</h2></a>
    <p>{{$post->content}}</p>
@endforeach
@endsection
