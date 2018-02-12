@extends('layout')
@section('content')
<table class="table table-striped">
    <tr>
        <th >内容確認</th>
        <th ></th>
    </tr>
    <tr>
        <td>Title</td>
        <td>{{ $memo_data->title }}</td>
    </tr>
    <tr>
        <td>Date</td>
        <td>{{ $memo_data->date }}</td>
    </tr>
    <tr>
        <td>Genre</td>
        @foreach ($genre_list as $genre_number => $genre)
            @if ($genre_number === $memo_data->genre)
                <td>{{ $genre }}</td>
            @endif
        @endforeach
    </tr>
    <tr>
        <td>Text</td>
        <td>{{ $memo_data->text }}</td>
    </tr>
</table>
    <a href="/memo" class="btn btn-primary">Back</a>
    <a href="complete_delete" class="btn btn-danger">削除</a>
@endsection
