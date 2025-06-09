<x-layout title="All Tasks">
    <div class="flex flex-col w-full space-y-8" x-data="taskCheckbox">
        <h1 class="w-full my-6 font-semibold text-center text-xl">A list of all your tasks</h1>
        <div class="completed-tasks-container hidden"></div>
        @forelse ($tasks->groupBy('category_id') as $categoryId => $tasksInCategory)
        <div class="w-full">
            @php
                $category = $tasksInCategory->first()->category;
            @endphp
            <h2 class="font-semibold text-lg mb-4">{{ $category ? $category->title : 'Uncategorized' }} <span class="text-gray-500 text-sm">({{ $tasksInCategory->count() }})</span></h2>
            <div class="space-y-4">
                @foreach ($tasksInCategory as $task)
                <div class="flex items-center justify-between p-4 border rounded-lg shadow-sm bg-white dark:bg-gray-800" data-task-id="{{ $task->id }}" data-list-id="{{ $task->id }}" data-title="{{ $task->title }}" data-description="{{ $task->description }}" data-deadline="{{ $task->deadline }}">
                    <div class="flex items-center space-x-4">
                        <input type="checkbox" x-on:change="updateTaskStatus" class="form-checkbox h-5 w-5 text-blue-600 task-checkbox" {{ $task->completed ? 'checked' : '' }}>
                        <a href="{{ route('lists.tasks.edit', [$category, $task]) }}" class="task-title text-gray-900 dark:text-gray-100 hover:underline {{ $task->completed ? 'line-through text-gray-400' : '' }}">{{ $task->title }}</a>
                    </div>
                    <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                        <p class="italic">{{ $task->description }}</p>
                        @if ($task->deadline)
                        <p class="italic">Due: {{ \Carbon\Carbon::parse($task->deadline)->format('Y-m-d H:i') }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @empty
            <p class="mx-auto">No task created yet. Create a <a href="{{ route('lists.index') }}" class="underline">list</a> then add a task.</p>
        @endforelse
    </div>
</x-layout>
