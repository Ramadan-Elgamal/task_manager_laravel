@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('tasks.index') }}" class="text-[var(--task-accent)] hover:text-[var(--task-accent-active)] font-medium text-sm flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Board
        </a>
    </div>

    <div class="bg-[var(--task-surface)] shadow-sm border border-[var(--task-border)] rounded-xl overflow-hidden">
        <div class="px-8 py-6 border-b border-[var(--task-border)]">
            <h2 class="text-2xl font-bold text-[var(--task-text)]">Create New Task</h2>
            <p class="text-sm text-[var(--task-muted)] mt-1">Define your next step and stay productive.</p>
        </div>

        <form action="{{ route('tasks.store') }}" method="POST" class="p-8 space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-[var(--task-text)]/90">Task Title</label>
                <input type="text" name="title" id="title" placeholder="e.g., Buy groceries" required
                    class="mt-1 block w-full bg-[var(--task-canvas)] border border-[var(--task-border)] rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-[var(--task-accent)] focus:border-[var(--task-accent)] sm:text-sm placeholder:text-[var(--task-muted)]">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-[var(--task-text)]/90">Description</label>
                <textarea name="description" id="description" rows="4" placeholder="What needs to be done? Add context, goals, or notes." required
                    class="mt-1 block w-full bg-[var(--task-canvas)] border border-[var(--task-border)] rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-[var(--task-accent)] focus:border-[var(--task-accent)] sm:text-sm placeholder:text-[var(--task-muted)]"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="due_date" class="block text-sm font-medium text-[var(--task-text)]/90">Due Date</label>
                    <input type="date" name="due_date" id="due_date" required
                        class="mt-1 block w-full bg-[var(--task-canvas)] border border-[var(--task-border)] rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-[var(--task-accent)] focus:border-[var(--task-accent)] sm:text-sm">
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-[var(--task-text)]/90">Priority</label>
                    <select name="priority" id="priority"
                        class="mt-1 block w-full bg-[var(--task-canvas)] border border-[var(--task-border)] rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-[var(--task-accent)] focus:border-[var(--task-accent)] sm:text-sm">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                        <option value="Urgent">Urgent</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="creator" class="block text-sm font-medium text-[var(--task-text)]/90">Creator</label>
                    <input type="text" name="creator" id="creator" placeholder="Enter your name" required
                        class="mt-1 block w-full bg-[var(--task-canvas)] border border-[var(--task-border)] rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-[var(--task-accent)] focus:border-[var(--task-accent)] sm:text-sm placeholder:text-[var(--task-muted)]">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-[var(--task-text)]/90">Status</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full bg-[var(--task-canvas)] border border-[var(--task-border)] rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-[var(--task-accent)] focus:border-[var(--task-accent)] sm:text-sm">
                        <option value="To Do">To Do</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Done">Done</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex justify-end space-x-3 border-t border-[var(--task-border)] mt-8 pt-6">
                <a href="{{ route('tasks.index') }}" class="bg-[var(--task-surface)] py-2 px-4 border border-[var(--task-border)] rounded-md shadow-sm text-sm font-medium text-[var(--task-text)] hover:bg-[var(--task-surface-strong)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--task-accent)]">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-[var(--task-canvas)] bg-[var(--task-accent)] hover:bg-[var(--task-accent-active)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--task-accent)]">
                    Create Task
                </button>
            </div>
        </form>
    </div>
</div>
@endsection