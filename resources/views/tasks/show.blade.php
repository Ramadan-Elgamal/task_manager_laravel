@extends('layouts.app')

@section('title', 'Task Details')

@section('content')
<div class="mb-6">
    <a href="{{ route('tasks.index') }}" class="text-[var(--task-accent)] hover:text-[var(--task-accent-active)] font-medium text-sm flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Board
    </a>
</div>

<div class="bg-[var(--task-surface)] shadow-sm border border-[var(--task-border)] rounded-xl overflow-hidden">
    <div class="p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold text-[var(--task-text)] mb-3">{{ $task['title'] }}</h1>
                <div class="flex flex-wrap items-center gap-4 text-sm text-[var(--task-text)]/70">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-[var(--task-muted)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Due: <span class="font-medium ml-1">{{ $task['due_date'] }}</span>
                    </span>
                    <span class="flex items-center border-l border-[var(--task-border)] pl-4">
                        Assigned to: <span class="font-medium text-[var(--task-text)] ml-1">{{ $task['creator'] }}</span>
                    </span>
                    <span class="px-2 py-1 rounded text-xs font-bold tracking-wide {{ strtolower($task['priority']) === 'urgent' ? 'bg-[var(--task-danger)]/20 text-[var(--task-danger)]' : 'bg-[var(--task-up)]/20 text-[var(--task-up)]' }}">
                        {{ strtoupper($task['priority']) }}
                    </span>
                    <span class="px-2 py-1 rounded text-xs font-bold tracking-wide bg-[var(--task-accent)]/20 text-[var(--task-accent)]">
                        {{ strtoupper($task['status']) }}
                    </span>
                </div>
            </div>
            <a href="{{ route('tasks.edit', $task['id']) }}" class="bg-[var(--task-surface-strong)] text-[var(--task-text)] px-4 py-2 rounded-md border border-[var(--task-border)] text-sm font-medium hover:bg-[var(--task-border)] transition">
                Edit Task
            </a>
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-semibold text-[var(--task-text)] border-b border-[var(--task-border)] pb-2 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-[var(--task-muted)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                </svg>
                Description
            </h3>
            <p class="text-[var(--task-text)]/80 leading-relaxed whitespace-pre-line">{{ $task['description'] }}</p>
        </div>
    </div>
</div>
@endsection