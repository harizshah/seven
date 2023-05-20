<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        $todos = auth()->user()->todos->sortBy('completed');
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
//        auth()->user()->todos()->create($request->all());
        $userId = auth()->id();
        $request['user_id'] = $userId;
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
    public function complete(Todo $todo)
    {
        $todo->update(['completed'=>true]);
        return redirect()->back()->with('message','Task Marked as completed!');
    }

    public function incomplete(Todo $todo)
    {
        $todo->update(['completed'=>false]);
        return redirect()->back()->with('message','Task Marked as INcompleted!');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->back()->with('message','Task Deleted!');
    }
}
