@extends('layouts.blog-post')

@section('title')
    {{$post->title}}
@endsection

@section('content')
    <h1>{{$post->title}}</h1>

    <p class="lead">
        by <a href="#">{{$post->author->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->header()}}" alt="Header">

    <hr>

    <!-- Post Content -->
    <p id="post-content" class="lead">{!! $post->content !!}</p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        @if (session('commentAdded'))
            <div class="alert alert-info">
                <i>Comment added. Waiting for approval.</i>
            </div>
        @endif
        @auth
            <h4>Leave a Comment:</h4>
            {!! Form::open(['method' => 'POST', 'action' => 'CommentsController@store']) !!}
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <div class="form-group">
                    {!! Form::textarea('content', null, ['rows' => 3, 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Comment', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
            @include('errors')
        @endauth
        @guest
            <a href="/login">Log In</a> to comment
        @endguest
    </div>

    <hr>

    <!-- Posted Comments -->

    @if (count($comments) > 0)
        @foreach ($comments as $comment)
            <div class="media">
                <img class="media-object pull-left" src="{{$comment->author->avatar}}" alt="Avatar" height="50">
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author->name}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                    {{$comment->content}}
                    <button class="toggle-reply btn btn-primary pull-right">Replies</button>
                    <div class="comment-reply-container" style="display: none; margin-top: 10px">
                        <!-- Nested Comment -->
                        @foreach ($comment->replies->where('is_active', true) as $reply)
                            <div class="media">
                                <img class="media-object pull-left" src="{{$reply->author->avatar}}" alt="Avatar" height="50">
                                <div class="media-body">
                                    <h4 class="media-heading">{{$reply->author->name}}
                                        <small>{{$reply->created_at->diffForHumans()}}</small>
                                    </h4>
                                    {{$reply->content}}
                                </div>
                            </div>
                        @endforeach
                        <!-- End Nested Comment -->
                        {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@store']) !!}
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            <div class="form-group" style="margin-top: 10px">
                                {!! Form::label('content', 'Leave a Reply:') !!}
                                {!! Form::textarea('content', null, ['rows' => 1, 'class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Reply', ['class' => 'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div>
            <i>No comments yet.</i>
        </div>
    @endif
@endsection

@section('categories')
    @foreach ($categories as $category)
        <li><a href="#">{{$category}}</a></li>
    @endforeach
@endsection

@section('scripts')
    <script>
        $('.toggle-reply').click(function() {
            $(this).toggleClass('btn-primary');
            $(this).toggleClass('btn-default');
            $(this).next().slideToggle('slow');
        });
    </script>
@endsection
