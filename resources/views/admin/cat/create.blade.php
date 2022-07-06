@extends('layouts.admin')
@section('title', '猫ちゃんの新規登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3>猫ちゃん新規登録</h3>
                
                <!-- 新規登録フォーム -->
                <form action="{{ action('Admin\CatController@create') }}" method="post" enctype="multipart/form-data">
                    
                    <!-- エラー確認 -->
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <!-- 名前を入力 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="name">名前</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    
                    <!-- 性別の登録 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="gender">性別</label>
                        <div class="col-md-2">
                            <input type="radio" name="gender" value="0" checked>オス
                        </div>
                        <div class="col-md-8">
                            <input type="radio" name="gender" value="1">メス
                        </div>
                    </div>
                    
                    <!-- 猫種の登録 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="type">種類</label>
                        <div class="col-md-10">
                            <select class="form-control" name="type">
                                <option value="" selected>猫種の選択</option>
                                <option value="0">スコティッシュフォールド</option>
                                <option value="1">マンチカン</option>
                                <option value="2">ラグドール</option>
                                <option value="3">ノルウェージャンフォレストキャット</option>
                                <option value="4">ミヌエット</option>
                                <option value="5">ベンガル</option>
                                <option value="6">ブリティッシュショートヘア</option>
                                <option value="7">エキゾチックショートヘア</option>
                                <option value="8">メインクーン</option>
                                <option value="9">アメリカンショートヘア</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- 簡易紹介の登録 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="introduction">紹介</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="5">{{ old('introduction') }}</textarea>
                        </div>
                    </div>
                    
                    <!-- 画像の添付 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    
                    <!-- 更新ボタン -->
                    @csrf
                    <input type="submit" class="btn btn-primary" value="登録">
                    
                </form>
            </div>
        </div>
    </div>
@endsection