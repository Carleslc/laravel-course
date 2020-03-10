@extends('layouts.app')

@section('content')
<!-- Alternative:
    {!! Form::model($post, ['method' => 'PUT', 'action' => ['PostController@update', $post->id]]) !!}
    (@csrf and method_field included)
-->
<form method="post" action="/posts/{{$post->id}}" enctype="multipart/form-data">
    @csrf
    {{ method_field('PUT') }}
    <div class="form-group">
        <input type="file" class="form-control-file" name="header">
    </div>
    <br>
    <div class="form-group">
        <input type="text" name="title" placeholder="Enter title" value="{{$post->title}}">
        <input type="text" name="content" placeholder="Post content" value="{{$post->content}}">
    </div>
    <br>
    <div class="form-group">
        <input type="submit" name="Edit" value="Edit" class="btn btn-success">
    </div>
</form>

@include('errors')
@endsection
