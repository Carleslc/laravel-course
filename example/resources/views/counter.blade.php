@extends('layouts.app')

@section('content')
@if (session()->get('reset'))
    <p class="alert alert-info">The counter has been reset.</p>
@endif
<p>{{$counter}}</p>
<form method="post" action="/count">
    @csrf
    {{ method_field('DELETE') }}
    <input type="submit" value="Reset" class="btn btn-secondary">
</form>
<br>
<i>Refresh to count</i>
@endsection
