@extends('layouts.admin')

@section('title', '登録済みのドリンクの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h3>ドリンク一覧</h3>
        </div>
        
        <!-- ドリンク新規登録へのリンク -->
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\DrinkController@add') }}" role="button" class="btn btn-primary">新規登録</a>
            </div>
            
            <!-- 検索フォーム -->
            <div class="col-md-8">
                <form action="{{ action('Admin\DrinkController@index') }}" method="get">
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
        
        <!-- ドリンク一覧を表示 -->
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="30%">名称</th>
                                <th width="30%">値段</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $drink)
                                <tr>
                                    <th>{{ $drink->id }}</th>
                                    <th>{{ $drink->name }}</th>
                                    <th>{{ $drink->price }}</th>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\DrinkController@edit', ['id' => $drink->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ action('Admin\DrinkController@delete', ['id' => $drink->id]) }}">削除</a>
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