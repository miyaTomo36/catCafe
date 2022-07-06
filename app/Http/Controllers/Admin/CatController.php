<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cat;

class CatController extends Controller
{
    public function add()
    {
        return view('admin.cat.create');
    } 
  
    //猫ちゃんの登録データを保存する
    public function create(Request $request)
    {
        
        //varidationを行う
        $this->validate($request, Cat::$rules);
        
        //modelからインスタンス(レコード)を生成
        $cat = new Cat;
        //フォームで入力された値を取得
        $form = $request->all();
        
        //フォームから画像が送信されてきたら、保存して、$cat->image_pathに画像のパスwp保存する
        if (isset($form['image'])) {
            $path = $request->fill('image')->store('public/image');
            $cat->image_path = basename($path);
        } else {
            $cat->image_path = null;
        }
        
        //フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        //フォームから送信されてきたimageを削除する
        unset($form['image']);
        
        //データベースに保存する
        $cat->fill($form);
        $cat->save();

        return redirect('admin/cat/create');
    }
    
    //登録した猫ちゃん一覧を表示する
    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        
        //$cond_nameがあればそれに一致するレコードを、なければ全てのレコードを取得する
        if ($cond_name != '') {
            //検索された検索結果を取得する
            //modelに対してwhereメソッドを指定して検索
            $posts = Cat::where('name', $cond_name)->get();
        } else {
            //検索条件となる名前が入力されていない場合は、登録してある全てのデータを取得
            $posts = Cat::all();
        }
        
        //index.blade.phpのファイルに取得したレコード($posts)と、ユーザーが入力した文字列($cond_name)を渡し、ページを開く
        return view('admin.cat.index', ['posts' => $posts, 'cond_name' => $cond_name]);
    }
    
    //登録した猫ちゃんを更新(編集画面)
    public function edit(Request $request)
    {
        //cat modelからデータを取得する
        $cat = Cat::find($request->id);
        if (empty($cat)) {
            abort(404);
        }
        return view('admin.cat.edit', ['cat_form' => $cat]);
    }
    
    //登録した猫ちゃんを更新(編集画面から送信されたフォームデータを処理)
    public function update(Request $request)
    {
        //validationをかける
        $this->validate($request, Cat::$rules);
        //cat modelからデータを取得する
        $cat = Cat::find($request->id);
        //送信されてきたフォームデータを格納する
        $cat_form = $request->all();
        
        //画像を変更した時の処理
        if ($request->remove == 'true') {
            $cat_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $cat_form['image_path'] = basename($path);
        } else {
            $cat_form['image_path'] = $cat->image_path;
        }
        
        //フォームから送信されてきたimageを削除する
        unset($cat_form['image']);
        //フォームから送信されてきたremoveを削除する
        unset($cat_form['remove']);
        //フォームから送信されてきた_tokenを削除する
        unset($cat_form['_token']);
        
        //該当するデータを上書きして保存する
        $cat->fill($cat_form)->save();
        
        return redirect('admin/cat');
    }
    
    //データの削除
    public function delete(Request $request)
    {
        //該当するblog modelを取得
        $cat = Cat::find($request->id);
        //削除する
        $cat->delete();
        
        return redirect('admin/cat/');
    }
}