<x-layout title="Overdue Tasks">
    <div class="flex flex-col w-full space-y-8">
        <h1 class="w-full my-6 font-semibold text-center text-xl">Overdue Tasks</h1>
        @forelse ($tasks->groupBy('category_id') as $categoryId => $tasksInCategory)
        <div class="w-full">
            @php
                $category = $tasksInCategory->first()->category;
            @endphp
            <h2 class="font-semibold text-lg mb-4">{{ $category ? $category->title : 'Uncategorized' }} <span class="text-gray-500 text-sm">({{ $tasksInCategory->count() }})</span></h2>
            <div class="space-y-4">
                @foreach ($tasksInCategory as $task)
                <div class="flex items-center justify-between p-4 border rounded-lg shadow-sm bg-white dark:bg-gray-800" data-task-id="{{ $task->id }}" data-list-id="{{ $category->id }}" data-title="{{ $task->title }}" data-description="{{ $task->description }}" data-deadline="{{ $task->due_date }}">
                    <div class="flex items-center space-x-4">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 task-checkbox" {{ $task->completed ? 'checked' : '' }}>
                        <a href="{{ route('lists.tasks.edit', [$category, $task]) }}" class="task-title text-gray-900 dark:text-gray-100 hover:underline {{ $task->completed ? 'line-through text-gray-400' : '' }}">{{ $task->title }}</a>
                    </div>
                    <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                        @if($task->label)
                        <span class="px-2 py-0.5 rounded text-white text-xs font-semibold {{ 
                            $task->label == 'Marketing' ? 'bg-blue-500' : 
                            ($task->label == 'Development' ? 'bg-orange-400' : 
                            ($task->label == 'Template' ? 'bg-green-400' : 'bg-gray-400')) }}">
                            {{ $task->label }}
                        </span>
                        @endif
                        @if($task->due_date)
                        <div class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</span>
                        </div>
                        @endif
                        <div class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2m-4 0H7a2 2 0 01-2-2v-6a2 2 0 012-2h6m-3 8v-4m0 0l3-3m-3 3l-3-3" />
                            </svg>
                            <span>{{ $task->comments_count ?? 0 }}</span>
                        </div>
                        @if($task->user && $task->user->avatar)
                        <img src="{{ $task->user->avatar }}" alt="User Avatar" class="h-6 w-6 rounded-full object-cover">
                        @else
                        <div class="h-6 w-6 rounded-full bg-gray-300 dark:bg-gray-600"></div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div class="mx-auto">
            <p>No overdue tasks.</p>
        </div>
        @endforelse
    </div>
</x-layout>
