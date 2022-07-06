@extends('layouts.admin')

@section('title', '登録済みのブログの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h3>ブログ一覧</h3>
        </div>
            
        <!-- ブログ新規作成へのリンク -->
        <div class="row">
            <div class="col-md-4">
                <a href ="{{ action('Admin\BlogController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            
            <!-- 検索フォーム -->
            <div class="col-md-8">
                <form action="{{ action('Admin\BlogController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">題名</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
        <!-- ブログ一覧を表示 -->
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">題名</th>
                                <th width="50%">本文</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $blog)
                                <tr>
                                    <th>{{ $blog->id }}</th>
                                    <td>{{ Str::limit($blog->title, 100) }}</td>
                                    <td>{{ Str::limit($blog->body, 250) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\BlogController@edit', ['id' => $blog->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ action('Admin\BlogController@delete', ['id' => $blog->id]) }}">削除</a>
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