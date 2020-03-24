@extends('layouts.admin')

@section('header')
    Create Post
@endsection

@section('content')
    {!! Form::open(['method' => 'POST', 'action' => 'AdminPostsController@store', 'files' => true]) !!}

    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        {!! Form::label('category_id', 'Category') !!}
        {!! Form::select('category_id', $categories, 0, ['class' => 'form-control']) !!}
        {!! Form::label('header', 'Header') !!}
        {!! Form::file('header', ['class' => 'form-control']) !!}
        {!! Form::label('content', 'Content') !!}
        {!! Form::textarea('content', '', ['rows' => 10, 'class' => 'form-control']) !!}
    </div>
    <br>
    <div class="form-group">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    @include('errors')
@endsection
