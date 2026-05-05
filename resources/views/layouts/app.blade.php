<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - @yield("title")</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[var(--task-canvas)] text-[var(--task-text)] font-sans antialiased">

    <nav class="bg-[var(--task-surface)] text-[var(--task-text)] border-b border-[var(--task-border)] shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="shrink-0 font-bold text-xl tracking-tight text-[var(--task-accent)]">TaskMaster</div>
                <div class="flex space-x-4">
                    <a href="{{ route('tasks.index') }}" class="text-[var(--task-text)]/80 hover:text-[var(--task-text)] px-3 py-2 text-sm font-medium transition">All Tasks</a>
                    <a href="{{ route('tasks.create') }}" class="bg-[var(--task-accent)] text-[var(--task-canvas)] px-4 py-2 rounded-md text-sm font-semibold shadow-sm hover:bg-[var(--task-accent-active)] transition">Add Task</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield("content")
    </main>

</body>

</html>