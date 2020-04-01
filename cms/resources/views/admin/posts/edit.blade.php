@extends('layouts.admin')

@section('header')
    Edit Post
@endsection

@section('content')
    <div class="col-sm-3">
        <img src="{{$post->header}}" alt="Header" class="img-responsive img-rounded">
    </div>

    <div class="col-sm-9">
        {!! Form::open(['method' => 'PUT', 'action' => ['AdminPostsController@update', $post->id], 'files' => true]) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', $post->title, ['class' => 'form-control']) !!}
            {!! Form::label('category_id', 'Category') !!}
            {!! Form::select('category_id', $categories, $post->category_id, ['class' => 'form-control']) !!}
            {!! Form::label('header', 'Header') !!}
            {!! Form::file('header', ['class' => 'form-control']) !!}
            {!! Form::label('content', 'Content') !!}
            {!! Form::textarea('content', $post->content, ['rows' => 3, 'class' => 'form-control']) !!}
        </div>
        <br>
        <div class="form-group">
            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy', $post->id]]) !!}

        <div class="form-group">
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        </div>

        {!! Form::close() !!}
    </div>

    @include('errors')
@endsection
