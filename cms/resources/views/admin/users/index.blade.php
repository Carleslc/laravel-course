@extends('layouts.admin')

@section('header')
    Users
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><img height="64" src="{{$user->avatar}}"></td>
                    <td><a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role ? $user->role->name : ''}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
