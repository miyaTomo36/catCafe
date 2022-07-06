@extends('layouts.admin')

@section('title', 'グッズの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3>グッズ新規登録</h3>
                
                <!-- 新規登録フォーム -->
                <form action="{{ action('Admin\GoodsController@create') }}" method="post" enctype"multipart/form-data">
                    
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
                    
                    <!-- 価格の登録 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="price">価格</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="price" value="{{ old('prise') }}">
                        </div>
                    </div>
                    
                    <!-- 詳細の登録 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="detail">詳細</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="detail" rows="10">{{ old('detail') }}</textarea>
                        </div>
                    </div>
                    
                    <!--  画像の添付 -->
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