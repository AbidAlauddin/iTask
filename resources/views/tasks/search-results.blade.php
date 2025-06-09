<x-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Search Results for "{{ $query }}"</h1>

        @if($tasks->isEmpty())
            <p class="text-gray-600 dark:text-gray-400">No tasks found matching your search.</p>
        @else
            <div class="space-y-6">
                @foreach ($tasks as $categoryId => $tasksInCategory)
                    @php
                        $category = $lists->firstWhere('id', $categoryId);
                    @endphp
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">
                            @if (is_null($categoryId) || $categoryId == 0)
                                Search Results
                            @else
                                {{ $category ? $category->title : 'Search Results' }}
                            @endif
                            <span class="text-gray-500 text-sm">({{ $tasksInCategory->count() }})</span>
                        </h2>
                        <ul class="list-disc list-inside space-y-1 text-gray-900 dark:text-gray-100">
                            @foreach ($tasksInCategory as $task)
                                <li>
                                    <input type="checkbox" class="form-checkbox mr-2" {{ $task->completed ? 'checked' : '' }} disabled>
                                    {{ $task->title }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
