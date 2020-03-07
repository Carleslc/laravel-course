@extends('layouts.app')

@section('content')
{!! Form::open(['method' => 'POST', 'action' => 'PostController@store']) !!}
    <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        {!! Form::label('content', 'Content:') !!}
        {!! Form::text('content', null, ['class' => 'form-control']) !!}
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}

@if ($errors->any())
    <div class="alert alert-warn">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
    </div>
@endif
@endsection
