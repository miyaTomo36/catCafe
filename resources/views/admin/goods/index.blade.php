@extends('layouts.admin')

@section('title', '登録済みのグッズの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h3>グッズ一覧</h3>
        </div>
    
        <!-- グッズ新規作成へのリンク -->
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\GoodsController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            
            <!-- 検索フォーム -->
            <div class="col-md-8">
                <form action="{{ action('Admin\GoodsController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">名称</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_name" value="{{ $cond_name }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- グッズ一覧を表示 -->
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="30%">名称</th>
                                <th width="30%">価格</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $goods)
                                <tr>
                                    <th>{{ $goods->id }}</th>
                                    <th>{{ $goods->name }}</th>
                                    <th>{{ $goods->price }}</th>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\GoodsController@edit', ['id' => $goods->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ action('Admin\GoodsController@delete', ['id' => $goods->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection