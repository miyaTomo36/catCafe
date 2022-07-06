@extends('layouts.admin')
@section('title', 'ドリンクの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3>ドリンク編集</h3>
                
                <!-- 編集フォーム -->
                <form action="{{ action('Admin\DrinkController@update') }}" method="post" enctype="multipart/form-data">
                    
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
                            <input type="text" class="form-control" name="name" value="{{ $drink_form->name }}">
                        </div>
                    </div>
                    
                    <!-- 値段の編集 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="price">値段</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="price" value="{{ $drink_form->price }}">
                        </div>
                    </div>
                    
                    <!-- 簡易紹介の編集 -->
                    <div class="form-group row">
                        <label class="col-md-2" for="feature">紹介</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="feature" rows="5">{{ $drink_form->feature }}</textarea>
                        </div>
                    </div>
                    
                    <!-- 更新ボタン -->
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $drink_form->id }}">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection