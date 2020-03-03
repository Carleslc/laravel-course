@extends('layouts.app')

@section('content')
<h2>(#{{$id}}) {{$post->title}}</h2>
<p>{{$post->content}}</p>
@endsection
