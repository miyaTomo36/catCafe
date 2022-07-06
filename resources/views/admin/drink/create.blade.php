@extends('layouts.admin')

@section('title', 'ドリンクの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3>ドリンク新規登録</h3>
                
                <!-- 新規登録フォーム -->
                <form action ="{{ action('Admin\DrinkController@create') }}" method="post" enctype="multipart/form-data">
                    
                    <!-- エラー確認 -->
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <!-- 名称の登録 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="name">名称</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    
                    <!-- 値段の登録 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="price">値段</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="price" value="{{ old('prise') }}">
                        </div>
                    </div>
                    
                    <!-- 簡易紹介の登録-->
                    <div class="form-group row">
                        <label class="col-md-2" for="feature">紹介</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="feature" rows="5">{{ old('feature') }}</textarea>
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