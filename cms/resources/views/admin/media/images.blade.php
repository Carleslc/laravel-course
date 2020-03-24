@if (!empty($images))
    <h2>{{$name}}</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($images as $image)
                <tr>
                    <td>{{basename($image)}}</td>
                    <td><img style="max-height:200px" src="{{Storage::url($image)}}"></td>
                    <td>
                        @if (!Str::startsWith(basename($image), 'default.png'))
                            {!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediaController@destroy', 'image' => $image]]) !!}
                            <div class="form-group">
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            </div>
                            {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
