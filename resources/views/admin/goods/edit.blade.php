@extends('layouts.admin')
@section('title', 'グッズの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3>グッズ編集</h3>
                
                <!-- 編集フォーム -->
                <form action="{{ action('Admin\GoodsController@update') }}" method="post" enctype="multipart/form-data">
                    
                    <!-- エラー確認 -->
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <!-- 名称の編集 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="name">名称</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $goods_form->name }}">
                        </div>
                    </div>
                    
                    <!-- 価格の編集 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="price">価格</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="price" value="{{ $goods_form->price }}">
                        </div>
                    </div>
                    
                    <!-- 詳細の編集 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="detail">詳細</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="detail" rows="10">{{ $goods_form->detail }}</textarea>
                        </div>
                    </div>
                    
                    <!-- 画像の編集 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type=file class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $goods_form->image_path }}
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
                            <input type="hidden" name="id" value="{{ $goods_form->id }}">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection