@extends('layouts.admin')
@section('title', '未完了タスク一覧')

@section('content')
<div class="container">
    <div class="row col-md-12">
        <h2>未完了タスク一覧</h2>
    </div>
    <div class="row">
        <div class="col-md-2">
            <a href="{{ action('Admin\TodoController@create') }}" role="button" class="btn btn-primary">新規作成</a>
        </div>
        <div class="col-md-4">
            <a href="{{ action('Admin\TodoController@completed') }}">完了済みタスク一覧へ</a>
        </div>
        <div class="col-md-6 pull-right">
            <form action="{{ action('Admin\TodoController@index') }}" method="get">
                <div class="form-group row">
                    <label class="col-md-2">タイトル</label>
                    <div class="col-md-4">
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
        <div class="list-news col-md-12 mx-auto">
            <div class="row">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="20%">タイトル</th>
                            <th width="50%">期限日</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $todo)
                        <tr>
                            <td>{{ $todo->id }}</td>
                            <td>{{ \Str::limit($todo->title, 100) }}</td>
                            @if ($todo->deadline_date == null)
                            <td></td>
                            @else
                            <td>{{ $todo->deadline_date->format('Y-m-d') }}</td>
                            @endif
                            <td>
                                <form action="{{ action('Admin\TodoController@complete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $todo->id }}" />
                                    <button type="submit" class="btn btn-primary">完了</button>
                                </form>
                            </td>
                            <td>
                                <p><a href="{{ action('Admin\TodoController@edit', ['id' => $todo->id]) }}">編集</a></p>
                                <p><a href="{{ action('Admin\TodoController@delete', ['id' => $todo->id]) }}">削除</a></p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $posts->links() }}
</div>
@endsection