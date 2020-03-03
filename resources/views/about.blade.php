@extends('layouts.app')

@section('content')
<h2>CMS from course at <a href="https://www.udemy.com/course/php-with-laravel-for-beginners-become-a-master-in-laravel/">PHP with Laravel for beginners - Become a Master in Laravel</a></h2>
<ul>
    @foreach ($links as $linkName => $link)
        <li><a href="{{$link}}"><i>{{$linkName}}</i></a></li>
    @endforeach
</ul>
@endsection
