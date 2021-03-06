@extends('layouts.admin')
@section('title', '完了済みタスク一覧')

@section('content')
<div class="container">
    <div class="row">
        <h2>完了済みタスク一覧</h2>
    </div>
    <div class="row">
        <div class="col-md-2">
            <a href="{{ action('Admin\TodoController@index') }}" role="button" class="btn btn-primary">新規作成</a>
        </div>
        <div class="col-md-4">
            <a href="{{ action('Admin\TodoController@index') }}">未完了タスク一覧へ</a>
        </div>
        <div class="col-md-6 pull-right">
            <form action="{{ action('Admin\TodoController@completed') }}" method="get">
                <div class="form-group row">
                    <label class="col-md-2">タイトル</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                    </div>
                    <div class="col-md-2">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="検索">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">

    </div>
</div>
@endsection