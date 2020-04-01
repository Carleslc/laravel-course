@extends('layouts.blog')

@section('content')
    <h1 class="page-header">
        {{$header ?? 'Posts'}}
    </h1>

    <!-- Blog Post -->
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <h2>
                <a href="{{route('posts.show', $post->slug)}}">{{$post->title}}</a>
            </h2>
            <p class="lead">
                by <a href="{{route('authors.show', $post->author->name)}}">{{$post->author->name}}</a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
            <hr>
            <img class="img-responsive" src="{{$post->header}}" alt="Post Header">
            <hr>
            <p>{!! Str::limit($post->content, 100) !!}</p>
            <a class="btn btn-primary" href="{{route('posts.show', $post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
        @endforeach
    @else
        <p>No posts yet.</p>
    @endif

    <!-- Pager -->
    <ul class="pager">
        <div class="row">
            {{$posts->render()}}
        </div>
    </ul>
@endsection
