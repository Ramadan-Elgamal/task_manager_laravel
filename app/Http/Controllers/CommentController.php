<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'required|string|min:1',
            'task_id' => 'required|exists:tasks,id',
            'user_id' => 'required|exists:users,id',
        ]);

        Comment::create([
            'body' => $validatedData['body'],
            'user_id' => $validatedData['user_id'],
            'commentable_id' => $validatedData['task_id'],
            'commentable_type' => Task::class,
        ]);

        return redirect()->route('tasks.show', $validatedData['task_id']);
    }
}
