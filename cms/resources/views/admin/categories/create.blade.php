@extends('layouts.admin')

@section('header')
    Create Category
@endsection

@section('content')
    {!! Form::open(['method' => 'POST', 'action' => 'AdminCategoriesController@store']) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <br>
    <div class="form-group">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    @include('errors')
@endsection
