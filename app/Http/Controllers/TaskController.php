<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    

    public function index()
    {
        $tasks = Task::with(['creator', 'assignee', 'comments.user'])->paginate(10);
        return view('tasks.index', compact('tasks'));

    }

    public function create()
    {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        Task::create($validated);
        return redirect()->route('tasks.index');
    }

    public function show(string $id)
    {
        $task = Task::where('id', $id)->with(['creator', 'assignee', 'comments.user'])->firstOrFail();
        $users = User::all();
        return view('tasks.show', compact('task', 'users'));
    }

    public function edit(string $id)
    {
        $task = Task::where('id', $id)->with(['creator', 'assignee'])->firstOrFail();
        $users = User::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = Task::findOrFail($id);
        $validated = $request->validated();
        $task->update($validated);

        return redirect()->route('tasks.index');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
