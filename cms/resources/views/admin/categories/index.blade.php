@extends('layouts.admin')

@section('header')
    Categories
@endsection

@section('content')
    <ul>
        @foreach ($categories as $category)
            <li>
                {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy', $category->id]]) !!}
                    {{$category->name}}
                    <button class="delete-icon">
                        <i class="fa fa-trash"></i>
                    </button>
                {!! Form::close() !!}
            </li>
        @endforeach
    </ul>
@endsection
