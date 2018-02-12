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
    <form action="confirm" method="POST" class="form-group">
        {{ csrf_field() }}
        @if (0 < count($errors))
        <label>Title</label><br>
            <input type="text" name="title" value="{{ old('title') }}"><br>
        <label>Date</label><br>
            <input type="date" name="date" value="{{ old('date') }}"><br>
        <label>Gerne</label><br>
            <select name="genre_number" class="form-control col-2">
                <option value="" @if (old('genre_number') == '') selected @endif >選択してください</option>
                @foreach ($genre_list as $number => $genre)
                    <option value="{{ $number }}" @if(old('genre_number') == $number) selected @endif >{{ $genre }}</option>
                @endforeach
            </select>
        <label>Text</label><br>
            <textarea name="text" class="form-control col-3" rows="4" placeholder="入力してください"{{ old('text') }}></textarea><br>
        @else
        <label>Title</label><br>
            <input type="text" name="title" value="{{ $input_data['title'] or '' }}"><br>
        <label>Date</label><br>
            <input type="date" name="date" value="{{ $input_data['date'] or '' }}"><br>
        <label>Gerne</label><br>
            <select name="genre_number" class="form-control col-2">
                <option value="" @if (! isset($input_data['genre_number'])) selected @endif >選択してください</option>
                @foreach ($genre_list as $number => $genre)
                    <option value="{{ $number }}" @if (isset($input_data['genre_number']) && $number === $input_data['genre_number']) selected @endif >{{ $genre }}</option>
                @endforeach
            </select>
        <label>Text</label><br>
            <textarea name="text" class="form-control col-3" rows="4" placeholder="入力してください">{{ $input_data['text'] or '' }}</textarea><br>
        @endif

        <a href="/memo" class="btn btn-info">一覧に戻る</a>
        <input type="submit" value="確認" class="btn btn-success">
    </form>
@endsection
