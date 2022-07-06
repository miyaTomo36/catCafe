@extends('layouts.admin')

@section('title', 'ブログの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3>ブログ編集</h3>
                
                <!-- 編集フォーム -->
                <form action="{{ action('Admin\BlogController@update') }}" method="post" enctype="multipart/form-data">
                    
                    <!-- エラー確認 -->
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <!-- 題名の編集 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="title">題名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $blog_form->title }}">
                        </div>
                    </div>
                    
                    <!-- 本文の編集 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="body">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ $blog_form->body }}</textarea>
                        </div>
                    </div>
                    
                    <!-- 画像の編集 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type=file class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $blog_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 更新ボタン -->
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $blog_form->id }}">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection