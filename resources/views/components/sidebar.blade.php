<div class="flex flex-col h-screen bg-white dark:bg-gray-900 shadow-lg w-64">
    <!-- Logo -->
    <div class="flex items-center justify-left h-20 border-b border-gray-200 dark:border-gray-700 px-4 space-x-2">
        <img src="{{ asset('images/Logo4.png') }}" alt="Logo" class="h-15 w-auto" />
        <span class="text-xl font-bold text-gray-900 dark:text-white">iTask</span>
    </div>

    <!-- Menu -->
    <nav class="flex-1 overflow-y-auto px-4 py-6">
        <div class="text-xs font-semibold text-gray-500 uppercase dark:text-gray-400 mb-4">Menu</div>
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('my-day') }}" class="flex items-center px-3 py-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"></path>
                    </svg>
                    Dashboard
                </a>
            </li>

            <!-- Calendar -->
            <li>
                <a href="#" class="flex items-center px-3 py-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Calendar
                </a>
            </li>
            <!-- Profile -->
            <li>
                <a href="{{ route('profile.edit') }}" class="flex items-center px-3 py-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 @if(Route::is('profile.edit')) bg-gray-100 dark:bg-gray-800 @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"></path>
                        <path d="M6 20v-2c0-2.21 3.58-4 6-4s6 1.79 6 4v2"></path>
                    </svg>
                    Profile
                </a>
            </li>

            <!-- Task with submenu -->
            <li class="relative">
                <button id="task-toggle" class="flex items-center justify-between w-full px-3 py-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M9 17v-6a2 2 0 012-2h6"></path>
                            <path d="M13 7h7v7"></path>
                            <path d="M5 12h4v4H5z"></path>
                        </svg>
                        Task
                    </span>
                    <svg id="task-arrow" class="w-4 h-4 transition-transform duration-200 @if(Route::is('all-task') || Route::is('my-day')) rotate-180 @endif" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <ul id="task-submenu" class="@if(Route::is('all-task') || Route::is('my-day') || Route::is('lists.index')) mt-2 space-y-1 pl-8 text-sm text-gray-600 dark:text-gray-400 @else hidden mt-2 space-y-1 pl-8 text-sm text-gray-600 dark:text-gray-400 @endif">
                    <li>
                        <a href="{{ route('lists.index') }}" class="block px-3 py-1 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">List</a>
                    </li>
                    <li>
                        <a href="{{ route('my-day') }}" class="block px-3 py-1 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">Upcoming</a>
                    </li>
                    <li>
                        <a href="{{ route('my-day') }}" class="block px-3 py-1 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">Due</a>
                    </li>
                    <li>
                        <a href="{{ route('my-day') }}" class="block px-3 py-1 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">Overdue</a>
                    </li>
                </ul>
            </li>
        </ul>
</nav>

    <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-4 mt-auto">
        <label for="dark-mode-toggle" class="flex items-center cursor-pointer">
            <div class="relative">
                <input type="checkbox" id="dark-mode-toggle" class="sr-only" />
                <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                <div class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition"></div>
            </div>
            <div class="ml-3 text-gray-700 dark:text-gray-300 font-medium">
                Dark Mode
            </div>
        </label>
    </div>

    <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-4">
        @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full px-3 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                Logout
            </button>
        </form>
        @endauth
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('task-toggle');
        const submenu = document.getElementById('task-submenu');
        const arrow = document.getElementById('task-arrow');

        toggleButton.addEventListener('click', function () {
            submenu.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        });

        // Dark mode toggle
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const toggleDot = darkModeToggle.parentElement.querySelector('.dot');

        // Initialize toggle state based on localStorage
        if (localStorage.getItem('darkMode') === 'enabled') {
            darkModeToggle.checked = true;
            document.documentElement.classList.add('dark');
            toggleDot.classList.add('translate-x-full', 'bg-gray-700');
        } else {
            darkModeToggle.checked = false;
            document.documentElement.classList.remove('dark');
            toggleDot.classList.remove('translate-x-full', 'bg-gray-700');
        }

        darkModeToggle.addEventListener('change', () => {
            if (darkModeToggle.checked) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('darkMode', 'enabled');
                toggleDot.classList.add('translate-x-full', 'bg-gray-700');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('darkMode', 'disabled');
                toggleDot.classList.remove('translate-x-full', 'bg-gray-700');
            }
        });
    });
</script>
</create_file>
