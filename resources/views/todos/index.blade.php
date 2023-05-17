@extends('todos.layout')

@section('content')
<div class="flex justify-center">
    <h1 class="text-2xl">All Your Todos</h1>
    <a href="/todos/create" class="mx-5 py-1 px-1 bg-blue-400 cursor-pointer text-white rounded">
        Create New</a>
</div>
    <ul class="my-5">
        @foreach($todos as $todo)
            <li class="flex justify-center py-2">
                <p>
                    {{$todo->title}}
                </p>
                <a href="{{'/todos/'.$todo->id.'/edit'}}" class="mx-5 py-1 px-1 bg-orange-400 cursor-pointer text-white rounded">
                    Edit</a>
            </li>
        @endforeach
    </ul>
@endsection

