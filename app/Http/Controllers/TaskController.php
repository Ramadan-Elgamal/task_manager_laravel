<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{


    public function index()
    {
        $tasks = Task::with(['creator', 'assignee', 'comments.user'])->latest()->paginate(10);
        return view('tasks.index', compact('tasks'));

    }

    public function create()
    {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    public function store(StoreTaskRequest $request)
    {
        $taskData = $request->safe()->except(['images']);

        $task = Task::create($taskData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('tasks', 'public');
                $task->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function show(string $id)
    {
        $task = Task::where('id', $id)->with(['creator', 'assignee', 'comments.user'])->firstOrFail();
        $users = User::all();
        return view('tasks.show', compact('task', 'users'))->with('success', 'Task created successfully!');
    }

    public function edit(string $id)
    {
        $task = Task::where('id', $id)->with(['creator', 'assignee'])->firstOrFail();
        $users = User::all();
        return view('tasks.edit', compact('task', 'users'))->with('success', 'Task updated successfully!');
    }

    /**
     * Update the specified task in the database.
     * Requirement: Upload the new image, Delete the old image from storage to avoid unused files.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $taskData = $request->safe()->except(['images']);
        
        $task->update($taskData);

        if ($request->hasFile('images')) {
            
            foreach ($task->images as $oldImage) {
                Storage::disk('public')->delete($oldImage->path);
            }
            
            $task->images()->delete();

            foreach ($request->file('images') as $newImage) {
                $path = $newImage->store('tasks', 'public');
                $task->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        foreach ($task->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
