@extends('layouts.app')

@section('content')
{!! Form::open(['method' => 'POST', 'action' => 'PostController@store', 'files' => true]) !!}
    <div class="form-group">
        {!! Form::file('header', ['class' => 'form-control']) !!}
    </div>
    <br>
    <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        {!! Form::label('content', 'Content:') !!}
        {!! Form::text('content', null, ['class' => 'form-control']) !!}
    </div>
    <br>
    <div class="form-group">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}

@include('errors')
@endsection
