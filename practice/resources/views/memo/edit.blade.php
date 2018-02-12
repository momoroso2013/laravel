
@extends('layout')
@section('content')
<h3 class="text-info">MEMO</h3>
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>validate error: {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <form action="complete_edit" method="POST" class="form-group">
        {{ csrf_field() }}
        <label>Title</label><br>
            <input type="text" name="title" value="{{ $memo_data->title }}"><br>
        <label>Date</label><br>
            <input type="date" name="date" value="{{ $memo_data->date }}"><br>
        <label>Gerne</label><br>
            <select name="genre_number" class="form-control col-2">
                @foreach ($genre_list as $genre_number => $genre)
                    <option value="{{ $genre_number }}" {{ $memo_data->genre == $genre_number ? 'selected' : '' }} >{{ $genre }}</option>
                @endforeach
            </select>
        <label>Text</label><br>
            <textarea name="text" class="form-control col-3" rows="4" >{{ $memo_data->text }}</textarea><br>
        <a href="/memo" class="btn btn-info">一覧に戻る</a>
        <input type="submit" value="編集" class="btn btn-success">
    </form>
@endsection
