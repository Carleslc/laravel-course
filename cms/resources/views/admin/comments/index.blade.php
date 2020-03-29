@extends('layouts.admin')

@section('header')
    Comments
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Author</th>
                <th>Comment</th>
                <th>Post</th>
                <th>Moderate</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <td>{{$comment->author->name}}</td>
                    <td>{{Str::of($comment->content)->limit(30)}}</td>
                    <td><a href="{{route('posts.show', $comment->post->slug)}}">{{$comment->post->title}}</a></td>
                    <td>
                        {!! Form::open(['method' => 'PUT', 'action' => ['CommentsController@update', $comment->id]]) !!}
                        <div class="form-group">
                            @if ($comment->is_active)
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
                        {!! Form::open(['method' => 'DELETE', 'action' => ['CommentsController@destroy', $comment->id]]) !!}
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
