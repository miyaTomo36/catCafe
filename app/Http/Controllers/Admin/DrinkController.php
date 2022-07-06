<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Drink;

class DrinkController extends Controller
{
    public function add()
    {
        return view('admin.drink.create');
    } 
  
    //ドリンクの登録データを保存する
    public function create(Request $request)
    {
        
        //varidationを行う
        $this->validate($request, Drink::$rules);
        
        //modelからインスタンス(レコード)を生成
        $drink = new Drink;
        //フォームで入力された値を取得
        $form = $request->all();
        
        //フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        
        //データベースに保存する
        $drink->fill($form);
        $drink->save();
        
        return redirect('admin/drink/create');
    }
    
    //登録したドリンク一覧を表示する
    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        
        //$cond_nameがあればそれに一致するレコードを、なければ全てのレコードを取得する
        if ($cond_name != '') {
            //検索された検索結果を取得する
            //modelに対してwhereメソッドを指定して検索
            $posts = Drink::where('name', $cond_name)->get();
        } else {
            //検索条件となる名前が入力されていない場合は、登録してある全てのデータを取得
            $posts = Drink::all();
        }
        
        //index.blade.phpのファイルに取得したレコード($posts)と、ユーザーが入力した文字列($cond_name)を渡し、ページを開く
        return view('admin.drink.index', ['posts' => $posts, 'cond_name' => $cond_name]);
    }
    
    //登録したドリンクを更新(編集画面)
    public function edit(Request $request)
    {
        //drink modelからデータを取得する
        $drink = Drink::find($request->id);
        if (empty($drink)) {
            abort(404);
        }
        return view('admin.drink.edit', ['drink_form' => $drink]);
    }
    
    //登録したドリンクを更新(編集画面から送信されたフォームデータを処理)
    public function update(Request $request)
    {
        //validationをかける
        $this->validate($request, Drink::$rules);
        //drink modelからデータを取得する
        $drink = Drink::find($request->id);
        //送信されてきたフォームデータを格納する
        $drink_form = $request->all();
        
        //フォームから送信されてきた_tokenを削除する
        unset($drink_form['_token']);
        
        //該当するデータを上書きして保存する
        $drink->fill($drink_form)->save();
        
        return redirect('admin/drink');
    }
    
    //データの削除
    public function delete(Request $request)
    {
        //該当するblog modelを取得
        $drink = Drink::find($request->id);
        //削除する
        $drink->delete();
        
        return redirect('admin/drink/');
    }
}
