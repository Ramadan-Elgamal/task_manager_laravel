@extends('layouts.app')

@section('title', 'Task Details')

@section('content')
<div class="px-6 py-8 lg:px-8">
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
                <h1 class="text-3xl font-bold text-[var(--task-text)] mb-3">{{ $task->title }}</h1>
                <div class="flex flex-wrap items-center gap-4 text-sm text-[var(--task-text)]/70">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-[var(--task-muted)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Due: <span class="font-medium ml-1">{{ $task->due_date }}</span>
                    </span>
                    <span class="flex items-center border-l border-[var(--task-border)] pl-4">
                        Creator: <span class="font-medium text-[var(--task-text)] ml-1">{{ $task->creator->name }}</span>
                    </span>
                    <span class="flex items-center border-l border-[var(--task-border)] pl-4">
                        Assignee: <span class="font-medium text-[var(--task-text)] ml-1">{{ optional($task->assignee)->name ?? 'Unassigned' }}</span>
                    </span>
                    <span class="px-2 py-1 rounded text-xs font-bold tracking-wide {{ strtolower($task->priority) === 'urgent' ? 'bg-[var(--task-danger)]/20 text-[var(--task-danger)]' : 'bg-[var(--task-up)]/20 text-[var(--task-up)]' }}">
                        {{ strtoupper($task->priority) }}
                    </span>
                    <span class="px-2 py-1 rounded text-xs font-bold tracking-wide bg-[var(--task-accent)]/20 text-[var(--task-accent)]">
                        {{ strtoupper($task->status) }}
                    </span>
                    <span class="flex items-center border-l border-[var(--task-border)] pl-4">
                        Posted On: <span class="font-medium ml-1">{{ $task->created_at->toDayDateTimeString() }}</span>
                    </span>
                </div>
            </div>
            <a href="{{ route('tasks.edit', $task->id) }}" class="bg-[var(--task-surface-strong)] text-[var(--task-text)] px-4 py-2 rounded-md border border-[var(--task-border)] text-sm font-medium hover:bg-[var(--task-border)] transition">
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
            <p class="text-[var(--task-text)]/80 leading-relaxed whitespace-pre-line">{{ $task->description }}</p>
        </div>

        <div class="mt-6">
            <h4 class="text-lg font-bold text-[var(--task-text)]">Task Gallery</h4>

            <div class="grid grid-cols-3 gap-4 mt-2">
                @forelse($task->images as $image)
                    <div class="border rounded p-1 border-[var(--task-border)] bg-[var(--task-canvas)]">
                        <img src="{{ $image->image_url }}" alt="Task Image" class="w-full h-auto rounded">
                    </div>
                @empty
                    <p class="text-[var(--task-muted)] text-sm">No images attached to this task.</p>
                @endforelse
            </div>
        </div>

        <div class="p-8">
            <h3 class="text-lg font-semibold text-[var(--task-text)] border-b border-[var(--task-border)] pb-2 mb-4">Comments</h3>
            <div class="space-y-4">
                @foreach($task->comments as $comment)
                    <div class="bg-[var(--task-canvas)] p-4 rounded-md border border-[var(--task-border)]">
                        <div class="text-sm text-[var(--task-text)] font-medium">{{ $comment->user->name }} <span class="text-xs text-[var(--task-muted)]">&middot; {{ $comment->created_at->diffForHumans() }}</span></div>
                        <p class="text-[var(--task-text)]/80 mt-2">{{ $comment->body }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                <h4 class="text-sm font-semibold text-[var(--task-text)] mb-2">Add a comment</h4>
                <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="body" class="block text-sm text-[var(--task-text)]/90">Comment</label>
                        <textarea name="body" id="body" rows="3" required class="mt-1 block w-full bg-[var(--task-canvas)] border border-[var(--task-border)] rounded-md py-2 px-3">{{ old('body') }}</textarea>
                        @error('body')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="user_id" class="block text-sm text-[var(--task-text)]/90">Commenter</label>
                            <select name="user_id" id="user_id" required class="mt-1 block w-full bg-[var(--task-canvas)] border border-[var(--task-border)] rounded-md py-2 px-3">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-[var(--task-canvas)] bg-[var(--task-accent)]">Post Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection