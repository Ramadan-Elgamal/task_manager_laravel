<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Lab 1</title>
</head>
<body>

    <nav>
        <h2>Task Manager Navbar</h2>
        <a href="{{ route('tasks.index') }}">All Tasks</a>
        <a href="{{ route('tasks.create') }}">Add Task</a>
    </nav>

    <main>
        @yield('content')
    </main>

</body>
</html>