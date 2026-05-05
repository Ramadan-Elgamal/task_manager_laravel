<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    private function getMockTasks()
    {
        return [
            [
                'id' => 1,
                'title' => 'Finalize Q4 Strategy',
                'description' => 'Project: Enterprise Growth. Align with the board on key objectives.',
                'creator' => 'Omar Ali',
                'priority' => 'Urgent',
                'status' => 'To Do',
                'due_date' => '2026-05-05',
            ],
            [
                'id' => 2,
                'title' => 'Buy groceries',
                'description' => 'Purchase weekly groceries: milk, eggs, bread, fruits, and vegetables. Check for discounts.',
                'creator' => 'Ramadan',
                'priority' => 'Medium',
                'status' => 'Done',
                'due_date' => '2026-05-05',
            ],
            [
                'id' => 3,
                'title' => 'Update portfolio',
                'description' => 'Creative Goals. Add recent automated workflow projects to the showcase.',
                'creator' => 'Ahmed Azab',
                'priority' => 'Low',
                'status' => 'In Progress',
                'due_date' => '2026-05-10',
            ]
        ];
    }

    public function index()
    {
        $tasks = $this->getMockTasks();
        return view('tasks.index', compact('tasks'));

    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('tasks.index');
    }

    public function show(string $id)
    {
        $tasks = $this->getMockTasks();
        foreach ($tasks as $task) {
            if ($task['id'] == $id) {
                return view('tasks.show', compact('task'));
            }
        }
        abort(404);
    }

    public function edit(string $id)
    {
        $tasks = $this->getMockTasks();
        foreach ($tasks as $task) {
            if ($task['id'] == $id) {
                return view('tasks.edit', compact('task'));
            }
        }
        abort(404);
    }

    public function update(Request $request, string $id)
    {
        return redirect()->route('tasks.index');
    }

    public function destroy(string $id)
    {
        return redirect()->route('tasks.index');
    }
}
