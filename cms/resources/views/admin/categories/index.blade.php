@extends('layouts.admin')

@section('header')
    Categories
@endsection

@section('content')
    <ul>
        @foreach ($categories as $category)
            <li>
                {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy', $category->id]]) !!}
                    <a href="{{route('categories.show', $category->name)}}">{{$category->name}}</a>
                    <button class="delete-icon">
                        <i class="fa fa-trash"></i>
                    </button>
                {!! Form::close() !!}
            </li>
        @endforeach
    </ul>
@endsection
