@extends('layouts.admin')

@section('title', 'ブログの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3>ブログ新規作成</h3>
                
                <!-- 新規作成フォーム -->
                <form action="{{ action('Admin\BlogController@create') }}" method="post" enctype="multipart/form-data">
                    
                    <!-- エラー確認 -->
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <!-- 題名を入力 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="title">題名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    
                    <!-- 本文を入力 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="body">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    
                    <!-- 画像を添付 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    
                    <!-- 投稿ボタン -->
                    @csrf
                    <input type="submit" class="btn btn-primary" value="投稿">
                
                </form>
            </div>
        </div>
    </div>
@endsection