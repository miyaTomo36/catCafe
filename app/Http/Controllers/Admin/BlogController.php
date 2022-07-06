<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    public function add()
    {
        return view('admin.blog.create');
    } 
    
    //ブログの投稿データを保存する
    public function create(Request $request)
    {
        
        //varidationを行う
        $this->validate($request, Blog::$rules);
        
        //modelからインスタンス(レコード)を生成
        $blog = new Blog;
        //フォームで入力された値を取得
        $form = $request->all();
        
        //フォームから画像が送信されてきたら、保存して、$blog->image_pathに画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $blog->image_path = basename($path);
        } else {
            $blog->image_path = null;
        }
        
        //フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        //フォームから送信されてきたimageを削除する
        unset($form['image']);
        
        //データベースに保存する
        $blog->fill($form);
        $blog->save();
        
        return redirect('admin/blog/create');
    }
    
    //投稿したブログ一覧を表示する
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        
        //$cond_titleがあればそれに一致するレコードを、なければ全てのレコードを取得する
        if ($cond_title != '') {
            //検索された検索結果を取得する
            //modelに対してwhereメソッドを指定して検索
            $posts = Blog::where('title', $cond_title)->get();
        } else {
            //検索条件となる名前が入力されていない場合は、登録してある全てのデータを取得
            $posts = Blog::all();
        }
        
        //index.blade.phpのファイルに取得したレコード($posts)と、ユーザーが入力した文字列($cond_title)を渡し、ページを開く
        return view('admin.blog.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    //投稿したブログを更新(編集画面)
    public function edit(Request $request)
    {
        //blog modelからデータを取得する
        $blog = Blog::find($request->id);
        if (empty($blog)) {
            abort(404);
        }
        return view('admin.blog.edit', ['blog_form' => $blog]);
    }
    
    //投稿したブログを更新(編集画面から送信されたフォームデータを処理)
    public function update(Request $request)
    {
        //validationをかける
        $this->validate($request, Blog::$rules);
        //blog modelからデータを取得する
        $blog = Blog::find($request->id);
        //送信されてきたフォームデータを格納する
        $blog_form = $request->all();
        
        //画像を変更した時の処理
        if ($request->remove == 'true') {
            $blog_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $blog_form['image_path'] = basename($path);
        } else {
            $blog_form['image_path'] = $blog->image_path;
        }
        
        //フォームから送信されてきたimageを削除する
        unset($blog_form['image']);
        //フォームから送信されてきたremoveを削除する
        unset($blog_form['remove']);
        //フォームから送信されてきた_tokenを削除する
        unset($blog_form['_token']);
        
        //該当するデータを上書きして保存する
        $blog->fill($blog_form)->save();
        
        return redirect('admin/blog');
    }
    
    //データの削除
    public function delete(Request $request)
    {
        //該当するblog modelを取得
        $blog = Blog::find($request->id);
        //削除する
        $blog->delete();
        
        return redirect('admin/blog/');
    }
}
