@extends('layout')
@section('content')
<h3>MEMO一覧</h3>
    <table class="table table-striped">
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Genre</th>
            <th>Text</th>
            <th></th>
            <th></th>
        </tr>
    @foreach ($memos as $memo)
        <tr>
            <td>{{ $memo->title }}</td>
            <td>{{ $memo->date }}</td>
            @foreach ($genre_list as $genre_number => $genre)
                @if ($genre_number === $memo->genre)
                    <td>{{ $genre }}</td>
                @endif
            @endforeach
            <td>{{ $memo->text }}</td>
    <td><a href="memo/edit?id={{ $memo->id }}">編集</a></td>
    <td><a href="memo/delete?id={{ $memo->id }}">削除</a></td>
    @endforeach
    </tr>
    </table>
    <a href="/" class="btn btn-info">戻る</a>
    <a href="/memo/input" class="btn btn-success">登録する</a>
@endsection
