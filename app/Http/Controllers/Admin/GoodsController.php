<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;

class GoodsController extends Controller
{
    public function add()
    {
        return view('admin.goods.create');
    } 
  
    //グッズの登録データを保存する
    public function create(Request $request)
    {
        
        //varidationを行う
        $this->validate($request, Goods::$rules);
        
        //modelからインスタンス(レコード)を生成
        $goods = new Goods;
        //フォームで入力された値を取得
        $form = $request->all();
        
        //フォームから画像が送信されてきたら、保存して、$cat->image_pathに画像のパスwp保存する
        if (isset($form['image'])) {
            $path = $request->fill('image')->store('public/image');
            $goods->image_path = basename($path);
        } else {
            $goods->image_path = null;
        }
        
        //フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        //フォームから送信されてきたimageを削除する
        unset($form['image']);
        
        //データベースに保存する
        $goods->fill($form);
        $goods->save();
        
        return redirect('admin/goods/create');
    }
    
    //登録したグッズ一覧を表示する
    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        
        //$cond_nameがあればそれに一致するレコードを、なければ全てのレコードを取得する
        if ($cond_name != '') {
            //検索された検索結果を取得する
            //modelに対してwhereメソッドを指定して検索
            $posts = Goods::where('name', $cond_name)->get();
        } else {
            //検索条件となる名前が入力されていない場合は、登録してある全てのデータを取得
            $posts = Goods::all();
        }
        
        //index.blade.phpのファイルに取得したレコード($posts)と、ユーザーが入力した文字列($cond_name)を渡し、ページを開く
        return view('admin.goods.index', ['posts' => $posts, 'cond_name' => $cond_name]);
    }
    
    //登録したグッズを更新(編集画面)
    public function edit(Request $request)
    {
        //goods modelからデータを取得する
        $goods = Goods::find($request->id);
        if (empty($goods)) {
            abort(404);
        }
        return view('admin.goods.edit', ['goods_form' => $goods]);
    }
    
    //登録したグッズを更新(編集画面から送信されたフォームデータを処理)
    public function update(Request $request)
    {
        //validationをかける
        $this->validate($request, Goods::$rules);
        //goods modelからデータを取得する
        $goods = Goods::find($request->id);
        //送信されてきたフォームデータを格納する
        $goods_form = $request->all();
        
        //画像を変更した時の処理
        if ($request->remove == 'true') {
            $goods_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $goods_form['image_path'] = basename($path);
        } else {
            $goods_form['image_path'] = $goods->image_path;
        }
        
        //フォームから送信されてきたimageを削除する
        unset($goods_form['image']);
        //フォームから送信されてきたremoveを削除する
        unset($goods_form['remove']);
        //フォームから送信されてきた_tokenを削除する
        unset($goods_form['_token']);
        
        //該当するデータを上書きして保存する
        $goods->fill($goods_form)->save();
        
        return redirect('admin/goods');
    }
    
    //データの削除
    public function delete(Request $request)
    {
        //該当するblog modelを取得
        $goods = Goods::find($request->id);
        //削除する
        $goods->delete();
        
        return redirect('admin/goods/');
    }
}
