@extends('layouts.admin')

@section('header')
    Media
@endsection

@section('content')
    {!! Form::open(['method' => 'DELETE', 'action' => 'AdminMediaController@destroy', 'class' => 'form-inline']) !!}
        @include('admin.media.images', ['name' => 'Avatars', 'images' => $avatars])
        @include('admin.media.images', ['name' => 'Headers', 'images' => $headers])
        @include('admin.media.images', ['name' => 'Uploaded', 'images' => $uploaded])
        <div class="form-group" style="margin-bottom: 20px">
            {!! Form::submit('Delete Selected', ['class' => 'btn btn-danger']) !!}
        </div>
    {!! Form::close() !!}
@endsection

@section('scripts')
    <script>
        $('input[value=select-all]').click(function() {
            let checkboxes = $(this).parents('table').first().find('td input[type=checkbox]');
            checkboxes.each(function() {
                this.checked = !this.checked;
            });
        });
    </script>
@endsection
