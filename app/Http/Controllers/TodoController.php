<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Step;
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

    public function show(Todo $todo)
    {
        return view('todos.show',compact('todo'));
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
        $todo = auth()->user()->todos()->create($request->all());
        if($request->step){
            foreach ($request->step as $step){
                $todo->steps()->create(['name' => $step]);
            }
        }
        //UPLOADING IMAGE
        return redirect(route("todo.index"))->with('message', 'Todo Created Successfully');

    }

    public function edit(Todo $todo)
    {
        return view('todos.edit',compact('todo'));
    }

    public function update(TodoCreateRequest $request,Todo $todo)
    {
        //update todo
        $todo->update(['title' => $request->title]);
        if($request->stepName){
            foreach ($request->stepName as $key => $value ){
                $id = $request->stepId[$key];
                if(!$id){
                    $todo->steps()->create(['name' => $value]);
                }else{
                    $step = Step::find($id);
                    $step->update(['name' => $value]);
                }
            }
        }
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
        $todo->steps->each->delete();
        $todo->delete();
        return redirect()->back()->with('message','Task Deleted!');
    }
}
