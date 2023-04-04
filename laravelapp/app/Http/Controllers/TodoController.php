<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index() {
        $todos = Todo::all();
        return view('todos.index', ['todos' => $todos]);
    }
    public function create() {
        return view('todos.create');
    }
    public function store(TodoRequest $request) {
        if($request->validated()) {
            Todo::create([
                "title" => $request->title,
                "description" => $request->description,
                "is_completed" => 0
            ]);

            $request->session()->flash('success', 'Todo creation sucessful');

            return redirect()->route('todos.index');
        }
    }
    public function edit($id) {
        $record = Todo::find($id);
        return view('todos.edit', ['todo'=>$record]);
    }

    public function view($id) {
        $record = Todo::find($id);
        return json_encode($record);
    }
    public function update(TodoRequest $request) {
        $todo = Todo::find($request->id);
        $todo->title=$request->title;
        $todo->description=$request->description;
        if($todo->save()) {
            $request->session()->flash('success', "Todo updated successfully");
        }
        return redirect('todos/edit/'.$request->id);
    }

    public function delete($id) {
        $todo = Todo::find($id);
        if($todo->delete()) {
            return "completed";
        }
    }


}
