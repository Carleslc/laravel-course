@extends('layouts.admin')

@section('content')
    <h1>Media</h1>

    @include('admin.media.images', ['name' => 'Avatars', 'images' => $avatars])
    @include('admin.media.images', ['name' => 'Headers', 'images' => $headers])
    @include('admin.media.images', ['name' => 'Uploaded', 'images' => $uploaded])
@endsection
