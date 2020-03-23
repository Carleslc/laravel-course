@extends('layouts.admin')

@section('content')
    <h1>Create Category</h1><br>

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
