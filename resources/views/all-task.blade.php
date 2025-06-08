<x-layout title="All Tasks">
    <div class="flex justify-center mx-auto w-full">
        <div class="flex flex-col w-full">
            <h1 class="w-full mb-6 font-semibold text-center">A list of all your tasks</h1>
            @forelse ($tasks as $task)
            <div class="flex max-w-full my-3 overflow-auto" data-task-id="{{ $task->id }}" data-list-id="{{ $task->category_id }}" data-title="{{ $task->title }}" data-description="{{ $task->description }}" data-deadline="{{ $task->deadline }}">
                <div class="flex items-center space-x-4">
                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 task-checkbox" {{ $task->completed ? 'checked' : '' }}>
                    <a href="{{ route('lists.tasks.edit', [$task->category_id, $task]) }}" class="task-title text-gray-900 dark:text-gray-100 hover:underline {{ $task->completed ? 'line-through text-gray-400' : '' }}">{{ $task->title }}</a>
                </div>
                <div class="flex flex-col ml-4">
                    <p class="text-sm italic">{{ $task->description }}</p>
                    @if ($task->deadline)
                    <p class="text-sm italic">Due: {{ $task->deadline }}</p>
                    @endif
                </div>
            </div>
            <hr class="mt-0 mb-6 w-24">
            @empty
                <p class="mx-auto">No task created yet. Create a <a href="{{ route('lists.index') }}" class="underline">list</a> then add a task.</p>
            @endforelse
        </div>
    </div>
</x-layout>
