<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - @yield("title")</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <nav class="bg-indigo-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="shrink-0 font-bold text-xl tracking-tight">TaskMaster</div>
                <div class="flex space-x-4">
                    <a href="{{ route('tasks.index') }}" class="hover:text-indigo-200 px-3 py-2 text-sm font-medium transition">All Tasks</a>
                    <a href="{{ route('tasks.create') }}" class="bg-white text-indigo-600 px-4 py-2 rounded-md text-sm font-semibold shadow-sm hover:bg-indigo-50 transition">Add Task</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield("content")
    </main>

</body>
</html>