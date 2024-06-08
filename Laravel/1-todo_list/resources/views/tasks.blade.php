@extends('layouts.master')
@section('title', "TASKs" )
   
    
@section('content')
    <nav class="mb-4">
        <a href="{{route('tasks.create')}}" class="link">Add Task</a>
    </nav>
    <div>
        @forelse ($tasks as $task)
            <div>
                <a href="{{route('tasks.show', ['task'=>$task->id])}}" 
                    @class(['line-through'=>$task->complete]) >{{$task->title}}</a> 
            </div>
        @empty
            <div>no task</div> 
        @endforelse
    
    </div>
    <nav class="mt-4">
        @if($tasks->count())
        {{ $tasks->links()}}

        @endif
    </nav>
@endsection