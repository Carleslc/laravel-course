@extends('layouts.admin')

@section('content')
    <h1>Edit User</h1><br>

    <div class="col-sm-3">
        <img src="{{$user->hasAvatar() ? $user->avatar() : $user->getDefaultAvatar()}}" alt="Avatar" class="img-responsive img-rounded">
    </div>

    <div class="col-sm-9">
        {!! Form::open(['method' => 'PUT', 'action' => ['AdminUsersController@update', $user->id], 'files' => true]) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
            {!! Form::label('role_id', 'Role') !!}
            {!! Form::select('role_id', $roles, $user->role_id, ['class' => 'form-control']) !!}
            {!! Form::label('avatar', 'Avatar') !!}
            {!! Form::file('avatar', ['class' => 'form-control']) !!}
            {!! Form::label('is_active', 'Active?') !!}
            {!! Form::checkbox('is_active', true, $user->is_active) !!}
        </div>
        <br>
        <div class="form-group">
            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) !!}

        <div class="form-group">
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        </div>

        {!! Form::close() !!}
    </div>

    @include('errors')
@endsection
