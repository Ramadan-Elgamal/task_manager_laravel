@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('tasks.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Board
    </a>
</div>

<div class="bg-white shadow-sm border border-gray-200 rounded-lg overflow-hidden">
    <div class="p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-3">{{ $task['title'] }}</h1>
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Due: <span class="font-medium ml-1">{{ $task['due_date'] }}</span>
                    </span>
                    <span class="flex items-center border-l border-gray-300 pl-4">
                        Assigned to: <span class="font-medium text-gray-900 ml-1">{{ $task['creator'] }}</span>
                    </span>
                    <span class="px-2 py-1 rounded text-xs font-bold tracking-wide {{ strtolower($task['priority']) === 'urgent' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ strtoupper($task['priority']) }}
                    </span>
                    <span class="px-2 py-1 rounded text-xs font-bold tracking-wide bg-yellow-100 text-yellow-800">
                        {{ strtoupper($task['status']) }}
                    </span>
                </div>
            </div>
            <a href="{{ route('tasks.edit', $task['id']) }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-md border border-gray-300 text-sm font-medium hover:bg-gray-200 transition">
                Edit Task
            </a>
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                Description
            </h3>
            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $task['description'] }}</p>
        </div>
    </div>
</div>
@endsection