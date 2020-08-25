@extends('layouts.admin')
@section('title', 'ToDoの新規作成')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>ToDo新規作成</h2>
            <form action="{{ action('Admin\TodoController@create') }}" method="post" >

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
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">期限日</label>
                    <div class="col-md-10">
                        <input type="date" class="form-control" name="deadline_date" value="{{ old('deadline_date') }}">
                    </div>
                </div>

                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="登録">
            </form>
        </div>
    </div>
</div>
@endsection