@extends('layouts.admin')
@section('title', 'ToDoの編集')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>ToDoの編集</h2>
            <form action="{{ action('Admin\TodoController@update') }}" method="post" >

                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="form-group row">
                    <label class="col-md-2">タイトル</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="title" value="{{ $todo->title }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">期限日</label>
                    <div class="col-md-10">
                        <input type="date" class="form-control" name="deadline_date" value="{{ $todo->deadline_date->format('Y-m-d') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-10">
                        <input type="hidden" name="id" value="{{ $todo->id }}">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="更新">
                        <a href="{{ action('Admin\TodoController@index') }}" role="button" class="btn btn-primary">戻る</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection