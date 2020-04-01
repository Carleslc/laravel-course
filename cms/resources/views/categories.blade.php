@section('categories')
    @foreach ($categories as $category)
        <li>{{$category}}</li>
    @endforeach
@endsection
