<x-layout>
    <div class="flex flex-col space-y-6 p-6">
        <!-- Header Image -->
        <div>
            <img src="{{ asset('images/header.png') }}" alt="Header Image" class="w-full h-48 object-cover rounded-lg shadow-md" />
        </div>

        <!-- Profile and Calendar Section -->
        <div class="flex flex-col md:flex-row md:space-x-6 items-center md:items-start">
        <!-- Profile and Greeting -->
        <a href="{{ route('profile.edit') }}" class="flex items-center space-x-4 bg-white dark:bg-gray-800 rounded-lg shadow p-4 flex-1 md:flex-none md:w-1/2 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
            <img src="{{ auth()->user()->avatar }}" alt="User Avatar" class="w-20 h-20 rounded-full object-cover border-2 border-indigo-500" />
            <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Hi, {{ strstr(auth()->user()->email, '@', true) }}!</h2>
                <p class="text-gray-600 dark:text-gray-300">What are we doing today?</p>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Organize everything in your life in one place.</p>
            </div>
        </a>

        <!-- Calendar -->
        <a href="{{ route('calendar') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 mt-4 md:mt-0 md:flex-1 md:w-1/2 hover:bg-gray-100 dark:hover:bg-gray-700 transition block">
            <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Today is</h2>
            <p class="text-gray-900 dark:text-gray-100 text-lg font-medium">{{ $formattedDate }}</p>
        </a>
        </div>

        <!-- Main Content: Tasks and Latest Notes -->
        <div class="flex flex-col md:flex-row md:space-x-6 max-h-[calc(100vh-300px)]">
            <!-- Tasks Section -->
            <main class="flex-1 h-full space-y-6 overflow-y-auto">
                <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Dashboard</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Upcoming Tasks -->
                    <a href="{{ route('upcoming') }}" class="block bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">
                            Upcoming
                            <span class="text-gray-500 text-sm">({{ $upcomingTasks->sum->count() }})</span>
                        </h2>
                        <div class="space-y-3">
                            @foreach ($upcomingTasks as $categoryId => $tasksInCategory)
                                @php
                                    $category = $tasksInCategory->first()->category;
                                @endphp
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ $category ? $category->title : 'Uncategorized' }}</h3>
                                    <ul class="list-disc list-inside space-y-1 text-gray-900 dark:text-gray-100">
                                        @foreach ($tasksInCategory as $task)
                                        <li>
                                            {{ $task->title }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </a>

                    <!-- Completed Tasks -->
                    <a href="{{ route('completed-tasks') }}" class="block bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-green-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">
                            Completed
                            <span class="text-gray-500 text-sm">({{ $completedTasks->sum->count() }})</span>
                        </h2>
                        <div class="space-y-3">
                            @foreach ($completedTasks as $categoryId => $tasksInCategory)
                                @php
                                    $category = $tasksInCategory->first()->category;
                                @endphp
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ $category ? $category->title : 'Uncategorized' }}</h3>
                                    <ul class="list-disc list-inside space-y-1 text-gray-900 dark:text-gray-100">
                                        @foreach ($tasksInCategory as $task)
                                        <li>
                                            {{ $task->title }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </a>

                    <!-- Due Tasks -->
                    <a href="{{ route('due') }}" class="block bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-yellow-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">
                            Due
                            <span class="text-gray-500 text-sm">({{ $dueTasks->sum->count() }})</span>
                        </h2>
                        <div class="space-y-3">
                            @foreach ($dueTasks as $categoryId => $tasksInCategory)
                                @php
                                    $category = $tasksInCategory->first()->category;
                                @endphp
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ $category ? $category->title : 'Uncategorized' }}</h3>
                                    <ul class="list-disc list-inside space-y-1 text-gray-900 dark:text-gray-100">
                                        @foreach ($tasksInCategory as $task)
                                        <li>
                                            {{ $task->title }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </a>

                    <!-- Overdue Tasks -->
                    <a href="{{ route('overdue') }}" class="block bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-red-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">
                            Overdue
                            <span class="text-gray-500 text-sm">({{ $overdueTasks->sum->count() }})</span>
                        </h2>
                        <div class="space-y-3">
                            @foreach ($overdueTasks as $categoryId => $tasksInCategory)
                                @php
                                    $category = $tasksInCategory->first()->category;
                                @endphp
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ $category ? $category->title : 'Uncategorized' }}</h3>
                                    <ul class="list-disc list-inside space-y-1 text-gray-900 dark:text-gray-100">
                                        @foreach ($tasksInCategory as $task)
                                        <li>
                                            {{ $task->title }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </a>
                </div>
            </main>

            <!-- Latest Notes Section -->
<div class="block w-full md:w-1/3 bg-white dark:bg-gray-800 rounded-lg shadow p-4 mt-6 md:mt-12 overflow-y-auto hover:bg-gray-100 dark:hover:bg-gray-700 transition">
    <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">
        Latest Notes
    </h2>
    <div class="space-y-3">
@forelse ($latestNotes as $note)
    <a href="{{ route('notes.show', $note->id) }}" class="block border-b border-gray-500 dark:border-gray-700 pb-2 px-3 hover:bg-indigo-100 dark:hover:bg-indigo-900 hover:text-indigo-700 dark:hover:text-indigo-300 cursor-pointer transition duration-200 rounded">
        <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ $note->title }}</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $note->created_at->format('d M Y') }}</p>
    </a>
@empty
    <p class="text-gray-600 dark:text-gray-400">No notes found.</p>
@endforelse
    </div>
</div>
        </div>
    </div>
</x-layout>
