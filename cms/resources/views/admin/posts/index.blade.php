@extends('layouts.admin')

@section('header')
    Posts
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Header</th>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td><img height="50" src="{{$post->header}}"></td>
                    <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
                    <td>{{Str::of($post->content)->limit(30)}}</td>
                    <td>{{$post->author->name}}</td>
                    <td>{{$post->category ? $post->category->name : ''}}</td>
                    <td><a href="{{route('posts.show', $post->slug ?? Str::slug($post->title))}}">View Post</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$posts->render()}}
        </div>
    </div>
@endsection
