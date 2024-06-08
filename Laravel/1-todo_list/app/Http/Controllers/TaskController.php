<?php

namespace App\Http\Controllers;

use App\Http\Requests\Taskrequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tasks', [
            'tasks'=> Task::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Taskrequest $request)
    {
        $task= Task::create($request->validated());

        return redirect()->route('tasks.show',['task' => $task->id]) ->with('success', 'Task Added Successfully!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('show', [
            'task'=> $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task )
    {
        return view('edit', [
            'task'=> $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Task $task, Taskrequest $request)
    {
        $task->update($request->validated());
        return redirect()->route('tasks.show',['task' => $task->id]) ->with('success', 'Task Edited Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function togglecomplete(Task $task)
    {
        $task->toggleComplete();
        return redirect()->back()
        ->with('success', 'Task Updated Successfully!');
    }
}
