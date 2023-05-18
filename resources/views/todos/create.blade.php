@extends('todos.layout')

@section('content')
    <h1 class="text-2xl border-b pb-4">What next you TO-DO</h1>
    <x-alert />
    <form method="post" action="/todos/create" class="py-5">
        @csrf
        <input type="text" name="title" class="py-2 px-2 border rounded" />
        <input type="submit" name="Create" class="p-2 border rounded" />
    </form>

    <a href="/todos" class="m-5 py-1 px-1 bg-white-400 cursor-pointer rounded border">Back To Home</a>
@endsection

