<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function index()
    {

        $todos = Todo::all();
        return view('todos.index',compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(TodoCreateRequest $request)
    {
//        $rules = [
//            'title' => 'required|max:255'
//        ];
//        $messages = [
//            'title.max' => 'Todo title should not be greater than 255 chars',
//        ];
//        $validator = Validator::make($request->all(), $rules, $messages);
//        if($validator->fails()){
//            return redirect()->back()
//                ->withErrors($validator)
//                ->withInput();
//        }
//        $request->validate([
//            'title' => 'required|max:255',
//        ]);
        Todo::create($request->all());
        //UPLOADING IMAGE
        return redirect()->back()->with('message','Todo Created Succesfully');
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit',compact('todo'));
    }

    public function update(TodoCreateRequest $request,Todo $todo)
    {
        //update todo
        $todo->update(['title' => $request->title]);
        return redirect(route('todo.index'))->with('message','Updated!');
    }
}
