@if($todo->completed)
    <span class="fas fa-check text-green-400 px-2 cursor-pointer"
          onclick="event.preventDefault();document.getElementById('form-incomplete-{{$todo->id}}').submit()"/>

@else
    <span onclick="event.preventDefault();document.getElementById('form-complete-{{$todo->id}}').submit()"
          class="fas fa-check text-gray-300 cursor-pointer px-2"/>

    <form style="display:none" id="{{'form-complete-'.$todo->id}}" method="post" action="{{(route('todo.complete',$todo->id))}}">
        @csrf
        @method('put')
    </form>
@endif
