@extends('layout')
@section('content')
<table class="table table-striped">
    <tr>
        <th >内容確認</th>
        <th ></th>
    </tr>
    <tr>
        <td>Title</td>
        <td>{{ $input_data['title'] }}</td>
    </tr>
    <tr>
        <td>Date</td>
        <td>{{ $input_data['date'] }}</td>
    </tr>
    <tr>
        <td>Genre</td>
        @foreach ($genre_list as $genre_number => $genre)
            @if ($genre_number === $input_data['genre'])
                <td>{{ $genre }}</td>
            @endif
        @endforeach
    </tr>
    <tr>
        <td>Text</td>
        <td>{{ $input_data['text'] }}</td>
    </tr>
</table>
    <a href="input" class="btn btn-primary">Back</a>
    <a href="complete" class="btn btn-success">登録</a>
@endsection
