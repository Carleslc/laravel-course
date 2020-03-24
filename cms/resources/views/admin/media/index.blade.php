@extends('layouts.admin')

@section('header')
    Media
@endsection

@section('content')
    @include('admin.media.images', ['name' => 'Avatars', 'images' => $avatars])
    @include('admin.media.images', ['name' => 'Headers', 'images' => $headers])
    @include('admin.media.images', ['name' => 'Uploaded', 'images' => $uploaded])
@endsection
