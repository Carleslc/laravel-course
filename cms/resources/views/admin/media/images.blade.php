@if (!empty($images))
    <h2>{{$name}}</h2>
    <table class="table">
        <thead>
            <tr>
                <th><input type="checkbox" value="select-all"></th>
                <th>Name</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($images as $image)
                <tr>
                    <td>
                        @if (!Str::startsWith(basename($image), 'default.png'))
                            <input type="checkbox" name="images[]" value="{{$image}}">
                        @endif
                    </td>
                    <td>{{basename($image)}}</td>
                    <td><img style="max-height:200px" src="{{Storage::url($image)}}"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
