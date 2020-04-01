@extends('layouts.blog')

@section('content')
    <h1 class="page-header">
        Posts
    </h1>

    <!-- Blog Post -->
    @foreach ($posts as $post)
        <h2>
            <a href="{{route('posts.show', $post->slug)}}">{{$post->title}}</a>
        </h2>
        <p class="lead">
            by <i>{{$post->author->name}}</i>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
        <hr>
        <img class="img-responsive" src="{{$post->header}}" alt="Post Header">
        <hr>
        <p>{!! Str::limit($post->content, 100) !!}</p>
        <a class="btn btn-primary" href="{{route('posts.show', $post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        <hr>
    @endforeach

    <!-- Pager -->
    <ul class="pager">
        <div class="row">
            {{$posts->render()}}
        </div>
    </ul>
@endsection
