@extends('layouts.admin')

@section('header')
    Upload Media
@endsection

@section('content')
    {!! Form::open(['method' => 'POST', 'action' => 'AdminMediaController@store', 'class' => 'dropzone']) !!}
    {!! Form::close() !!}
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
@endsection
