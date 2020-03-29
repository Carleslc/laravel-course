@extends('layouts.admin')

@section('header')
    Comment Replies
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Author</th>
                <th>Reply To</th>
                <th>Comment</th>
                <th>Post</th>
                <th>Moderate</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($replies as $reply)
                <tr>
                    <td>{{$reply->author->name}}</td>
                    <td>{{Str::of($reply->comment->content)->limit(30)}}</td>
                    <td>{{Str::of($reply->content)->limit(30)}}</td>
                    <td><a href="{{route('posts.show', $reply->comment->post->slug)}}">{{$reply->comment->post->title}}</a></td>
                    <td>
                        {!! Form::open(['method' => 'PUT', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
                        <div class="form-group">
                            @if ($reply->is_active)
                                <input type="hidden" name="is_active" value="false">
                                {!! Form::submit('Reject', ['class' => 'btn btn-default']) !!}
                            @else
                                <input type="hidden" name="is_active" value="true">
                                {!! Form::submit('Approve', ['class' => 'btn btn-success']) !!}
                            @endif
                        </div>
                        {!! Form::close() !!}
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['CommentRepliesController@destroy', $reply->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
