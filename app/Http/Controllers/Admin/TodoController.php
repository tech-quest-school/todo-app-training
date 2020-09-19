<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ToDo;
use App\Tag;
use App\TodoTag;
use App\Category;
use Auth;
use Carbon\Carbon;

class TodoController extends Controller
{
    public function add()
    {
        return view('admin.todo.create');
    }

    public function create(Request $request)
    {
        $this->validate($request, ToDo::$rules);
        $todo = new ToDo;

        $form = $request->all();

        unset($form['_token']);

        $todo->fill($form);
        $todo->user_id = Auth::id();
        $todo->is_complete = 0;

        $todo->save();

        // Todo一覧へ遷移する
        return redirect('admin/todo/');
    }

    public function index(Request $request)
    {
        $condTitle = $request->cond_title;

        // タイトルの検索入力があれば、検索条件を付与する
        if ($condTitle != '') {
            $toDoQuery = ToDo::where('title', 'LIKE', "%{$condTitle}%")->where('is_complete', 0);
        } else {
            $toDoQuery = ToDo::where('is_complete', 0);
        }

        //  一覧画面にページネーションを設定する（5件単位）
        $toDos = $toDoQuery->paginate(5);

        return view('admin.todo.index', ['posts' => $toDos, 'cond_title' => $condTitle]);
    }

    public function edit(Request $request)
    {
        $todo = ToDo::find($request->id);
        if (empty($todo)) {
            abort(404);
        }

        return view('admin.todo.edit', ['todo' => $todo]);
    }

    public function update(Request $request)
    {
        $this->validate($request, ToDo::$rules);
        $todo = ToDo::find($request->id);
        $form = $request->all();

        unset($form['_token']);

        $todo->fill($form)->save();

        return redirect('admin/todo');
    }

    public function delete(Request $request)
    {
        $todo = ToDo::find($request->id);

        $todo->delete();

        return redirect('admin/todo/');
    }

    /**
     * 完了済みタスク一覧ページ
     *
     * @param Request $request
     * @return void
     */
    public function completed(Request $request)
    {
        $condTitle = $request->cond_title;
        //タイトルの検索入力があれば、検索条件を付与する
        if ($condTitle != '') {
            $toDoQuery = ToDo::where('title', 'LIKE', "%{$condTitle}%")->where('is_complete', 1);
        } else {
            $toDoQuery = ToDo::where('is_complete', 1);
        }
        //一覧画面にページネーションを設定する(5件単位)
        $toDos = $toDoQuery->paginate(5);
        return view('admin.todo.completed', ['posts' => $toDos, 'cond_title' => $condTitle]);
    }

    public function complete(Request $request)
    {
        $todo = ToDo::find($request->id);
        $todo->is_complete = 1;
        $todo->save();

        return redirect('admin/todo');
    }

    public function uncomplete(Request $request)
    {
        $todo = ToDo::find($request->id);
        $todo->is_complete = 0;
        $todo->save();

        return redirect('admin/todo/');
    }
}
