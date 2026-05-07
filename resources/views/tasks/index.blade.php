@extends('layouts.app')

@section('title', 'Task List')

@section('content')
<div class="flex justify-between items-center mb-6 gap-4 flex-wrap">
    <div>
        <p class="text-xs uppercase tracking-[0.2em] text-[var(--task-muted)]">Overview</p>
        <h1 class="text-3xl font-bold text-[var(--task-text)] mt-1">Task List</h1>
    </div>
    <!-- Static search bar placeholder to match PDF mockup -->
    <div class="flex">
        <input type="text" placeholder="Search tasks..." class="bg-[var(--task-surface)] border border-[var(--task-border)] rounded-lg px-4 py-2 text-sm text-[var(--task-text)] placeholder:text-[var(--task-muted)] focus:ring-2 focus:ring-[var(--task-accent)] focus:border-[var(--task-accent)] w-64">
    </div>
</div>

<div class="bg-[var(--task-surface)] shadow-sm rounded-xl border border-[var(--task-border)] overflow-hidden">
    <table class="min-w-full divide-y divide-[var(--task-border)]">
        <thead class="bg-[var(--task-surface-strong)]">
            <tr>
                <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[var(--task-muted)] uppercase tracking-wider">id</th> -->
                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[var(--task-muted)] uppercase tracking-wider">Title</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[var(--task-muted)] uppercase tracking-wider">Creator</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[var(--task-muted)] uppercase tracking-wider">Priority</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[var(--task-muted)] uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[var(--task-muted)] uppercase tracking-wider">Due Date</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[var(--task-muted)] uppercase tracking-wider">Created At</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[var(--task-muted)] uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-transparent divide-y divide-[var(--task-border)]">
            @foreach($tasks as $task)
            <tr class="hover:bg-[var(--task-surface-strong)]/60 transition duration-150">
                <!-- <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--task-muted)]">{{ str_pad($task->id, 2, '0', STR_PAD_LEFT) }}</td> -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-[var(--task-text)]">{{ $task->title }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--task-text)]/80">{{ $task->user->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ strtolower($task->priority) === 'urgent' ? 'bg-[var(--task-danger)]/20 text-[var(--task-danger)]' : 'bg-[var(--task-up)]/20 text-[var(--task-up)]' }}">
                        {{ strtoupper($task->priority) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--task-text)] font-medium">{{ $task->status }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--task-text)]/80">{{ $task->due_date }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--task-text)]/80">{{ $task->created_at->format('d M, Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2 flex items-center">
                    <a href="{{ route('tasks.show', $task->id) }}">
                        <x-button type="primary">View</x-button>
                    </a>

                    <a href="{{ route('tasks.edit', $task->id) }}">
                        <x-button type="secondary">Edit</x-button>
                    </a>

                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirmDelete()" class="inline-flex justify-center items-center px-4 py-2 text-sm font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 transition duration-150 ease-in-out bg-[var(--task-danger)] text-white hover:bg-[#d63d52] focus:ring-[var(--task-danger)] border border-transparent">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $tasks->links() }}
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this task? Choose 'OK' for Yes or 'Cancel' for No.");
    }
</script>
@endsection