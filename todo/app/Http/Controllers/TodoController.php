<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\todo;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $todo_lists = todo::all();

        return view('todo_list.index', ['todo_lists', $todo_lists]);
    }

    public function create(Request $request)
    {
        $todo = new Todo();
        $todo->task_name = $request->task_name;
        $todo->task_description = $request->task_description;
        $todo->assign_person_name = $request->assign_person_name;
        $todo->estimate_hour = $request->estimate_hour;
        $todo->save();

        return redirect('/');
    }

    public function editPage($id)
    {
        $todo = Todo::find($id);
        return view('todo_edit', [
            "todo" => $todo
        ]);
    }

    public function deletePage($id)
    {
        $todo = Todo::find($id);
        return view('todo_delete', [
            "todo" => $todo
        ]);
    }

    public function delete(Request $id)
    {
        Todo::find($id)->delete();
        return redirect('/');
    }
}
