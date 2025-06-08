<x-layout title="Lists">
    <div class="flex w-full justify-end">
        <a href="{{ route('lists.create') }}" class="p-3 rounded border-2 dark:border-0 dark:bg-gray-800 dark:hover:bg-gray-700">+ Add list</a>
    </div>
    <div class="flex flex-col w-full space-y-8">
        <h1 class="w-full my-6 font-semibold text-center text-xl">Your lists</h1>
        @forelse ($category as $list)
        <div class="w-full">
            <div class="flex justify-between items-center mb-4 relative">
                <h2 class="font-semibold text-lg">{{ $list->title }} <span class="text-gray-500 text-sm">({{ $list->tasks->count() }})</span></h2>
                <div x-data="{ open: false }" class="relative inline-block text-left">
                    <button @click="open = !open" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-2 py-1 bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none" id="menu-button" aria-expanded="true" aria-haspopup="true">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h.01M12 12h.01M18 12h.01" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-10" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" style="display: none;">
                        <div class="py-1" role="none">
                            <a href="{{ route('lists.tasks.create', $list) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem" tabindex="-1" id="menu-item-0">Add Task</a>
                            <a href="{{ route('lists.edit', $list) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">Edit</a>
                            <form action="{{ route('lists.destroy', $list) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this list and its tasks?');" role="none">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem" tabindex="-1" id="menu-item-2">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-4">
@forelse ($list->tasks as $task)
                <div class="flex items-center justify-between p-4 border rounded-lg shadow-sm bg-white dark:bg-gray-800" data-task-id="{{ $task->id }}" data-list-id="{{ $list->id }}" data-title="{{ $task->title }}" data-description="{{ $task->description }}" data-deadline="{{ $task->deadline }}">
                    <div class="flex items-center space-x-4">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 task-checkbox" {{ $task->completed ? 'checked' : '' }}>
                        <a href="{{ route('lists.tasks.edit', [$list, $task]) }}" class="task-title text-gray-900 dark:text-gray-100 hover:underline {{ $task->completed ? 'line-through text-gray-400' : '' }}">{{ $task->title }}</a>
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
                @empty
                <p class="text-gray-500 dark:text-gray-400">No tasks in this list.</p>
                @endforelse
            </div>
        </div>
        @empty
        <div class="mx-auto">
            <p>No lists yet.</p>
        </div>
        @endforelse
    </div>
</x-layout>
