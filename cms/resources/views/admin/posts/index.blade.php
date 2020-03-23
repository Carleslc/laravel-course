@extends('layouts.admin')

@section('content')
    <h1>Posts</h1>
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
                    <td><img height="50" src="{{$post->header()}}"></td>
                    <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
                    <td>{{$post->content}}</td>
                    <td>{{$post->author->name}}</td>
                    <td>{{$post->category_id ? $post->category_id : ''}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
