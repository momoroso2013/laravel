<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemoController extends Controller
{
    public function index(Request $request)
    {

        // メモ一覧取得
        $memos = DB::select('select * from register');

        // ジャンル一覧取得
        $genre_list = $this->getGenreList();

        // セッション削除
        $request->session()->forget('memo_id');
        $request->session()->forget('input_data');

        return view('memo.index', ['memos' => $memos], ['genre_list' => $genre_list]);
    }

    public function input(Request $request)
    {
        // ジャンル一覧取得
        $genre_list = $this->getGenreList();

        // completeから戻ってきた場合、入力値の再現
        if ($request->session()->has('input_data')) {
            $input_data = $request->session()->get('input_data');
            return view('memo.input',['input_data' => $input_data], ['genre_list' => $genre_list]);
        }

        return view('memo.input', ['genre_list' => $genre_list]);
    }

    public function confirm(Request $request)
    {

        // ジャンル一覧取得
        $genre_list = $this->getGenreList();

        $validate = [
            'title' => 'required | ',
            'date' => 'required | date',
            'genre_number' => 'required | integer',
            'text' => 'required | max:1000'
        ];

        $this->validate($request, $validate);

        // 選択されたジャンルの値を取得
        $genre_number = (int) $request->genre_number;

        // ジャンル一覧になければ「その他」を選択させる
        if (! array_key_exists($genre_number, $genre_list)) {
            $genre_number = 4;
        }

        $input_data = [
            'title' => $request->title,
            'date'  => $request->date,
            'genre' => $genre_number,
            'text'  => $request->text
        ];

        // 入力値のセッション保存
        $request->session()->put('input_data', $input_data);

        return view('memo.confirm', ['input_data' => $input_data], ['genre_list' => $genre_list]);
    }

    public function complete(Request $request)
    {

        // 入力値の呼び出し
        $input_data = $request->session()->get('input_data');

        // パラメーター作成
        $params = [
            'title' => $input_data['title'],
            'date' => $input_data['date'],
            'genre' => $input_data['genre'],
            'text' => $input_data['text']
        ];

        // 入力値のDB保存
        DB::insert('insert into register (title, date, genre, text) values (:title, :date, :genre, :text)', $params);

        // セッション削除
        $request->session()->forget('input_data');


        return view('memo.complete');
    }

    public function edit(Request $request)
    {

        // 編集したいIDの取得
        $memo_id = $request->id;

        $request->session()->put('memo_id', $memo_id);

        $params = [
            'id' => $memo_id
        ];

        // DBから編集したいデータ取得
        $memo_data = DB::select('select * from register where id = :id', $params);

        // ジャンル一覧取得
        $genre_list = $this->getGenreList();

        return view('memo.edit', ['memo_data' => $memo_data[0]], ['genre_list' => $genre_list]);
    }

    public function complete_edit(Request $request)
    {

        // 編集したいIDの取得
        $memo_id = $request->session()->get('memo_id');

        $params = [
            'id' => $memo_id,
            'title' => $request->title,
            'date' => $request->date,
            'genre' => $request->genre_number,
            'text' => $request->text
        ];

        // 内容更新
        DB::update('update register set title = :title, date = :date, genre = :genre, text = :text where id = :id', $params);

        // セッション削除
        $request->session()->forget('memo_id');

        return view('memo.complete_edit');
    }

    public function delete(Request $request)
    {
        // 削除したいID取得
        $memo_id = $request->id;

        $params = [
            'id' => $memo_id
        ];

        $request->session()->put('memo_id', $memo_id);

        // 削除したい内容をDBから取得
        $memo_data = DB::select('select * from register where id = :id', $params);

        // ジャンル一覧取得
        $genre_list = $this->getGenreList();

        return view('memo.delete', ['memo_data' => $memo_data[0]], ['genre_list' => $genre_list]);
    }

    public function complete_delete(Request $request)
    {

        // 削除したいID取得
        $memo_id = $request->session()->get('memo_id');

        $params = [
            'id' => $memo_id,
        ];

        // 削除
        DB::delete('delete from register where id = :id', $params);

        // セッション削除
        $request->session()->forget('memo_id');

        return view('memo.complete_delete');
    }

    private function getGenreList()
    {
         return $genre_list = [
                    1 => '仕事',
                    2 => 'プライベート',
                    3 => '急ぎ',
                    4 => 'その他'
                ];
    }
}
