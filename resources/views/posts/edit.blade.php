@extends('layouts.app')

@section('content')
<!-- Alternative:
    {!! Form::model($post, ['method' => 'PUT', 'action' => ['PostController@update', $post->id]]) !!}
    (@csrf and method_field included)
-->
<form method="post" action="/posts/{{$post->id}}">
    @csrf
    {{ method_field('PUT') }}
    <input type="text" name="title" placeholder="Enter title" value="{{$post->title}}">
    <input type="text" name="content" placeholder="Post content" value="{{$post->content}}">
    <input type="submit" name="Edit">
</form>
@endsection
