<div class="flex flex-col h-screen bg-white dark:bg-gray-900 shadow-lg w-64">
    <!-- Logo -->
    <div class="flex items-center justify-center h-16 border-b border-gray-200 dark:border-gray-700">
        <span class="text-2xl font-bold text-gray-900 dark:text-white">Logo</span>
    </div>

    <!-- Menu -->
    <nav class="flex-1 overflow-y-auto px-4 py-6">
        <div class="text-xs font-semibold text-gray-500 uppercase dark:text-gray-400 mb-4">Menu</div>
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
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

            <!-- Task with submenu -->
            <li x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M9 17v-6a2 2 0 012-2h6"></path>
                            <path d="M13 7h7v7"></path>
                            <path d="M5 12h4v4H5z"></path>
                        </svg>
                        Task
                    </span>
                    <svg :class="{'transform rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <ul x-show="open" x-transition class="mt-2 space-y-1 pl-8 text-sm text-gray-600 dark:text-gray-400">
                    <li>
                        <a href="{{ route('all-task') }}" class="block px-3 py-1 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">List</a>
                    </li>
                    <li>
                        <a href="#" class="block px-3 py-1 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">Kanban</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
