<header class="fixed top-0 left-0 right-0 flex items-center justify-between bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 pl-64 pr-10 h-20 z-50" x-data="{ profileMenuOpen: false }" @toggle-sidebar.window="$dispatch('toggle-sidebar')">
    <div class="flex items-center space-x-4 h-full w-full">
        <!-- Search input -->
        <form action="{{ route('tasks.search') }}" method="GET" class="relative h-full flex items-center w-full max-w-md">
            <input type="text" name="query" placeholder="Search tasks..." class="pl-10 pr-4 py-2 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 h-10 w-full" value="{{ request('query') }}" />
            <div class="absolute left-3 text-gray-400 dark:text-gray-500 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                </svg>
            </div>
        </form>
    </div>

<!-- Dark Mode Toggle Icon and Profile section combined -->
<div class="relative flex items-center space-x-3 h-full">
    <div x-data="darkMode" @click="toggleTheme()" class="flex items-center cursor-pointer border-2 rounded-full p-2" :class="currentTheme === 'dark' ? 'border-yellow-600' : 'border-indigo-600'">
        <template x-if="currentTheme !== 'dark'">
            <!-- Light mode icon (moon) -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
            </svg>
        </template>
        <template x-if="currentTheme === 'dark'">
            <!-- Dark mode icon (sun) with indigo outline -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m8.66-9h-1M4.34 12h-1m15.07 4.24l-.7-.7M6.34 6.34l-.7-.7m12.02 12.02l-.7-.7M6.34 17.66l-.7-.7M12 7a5 5 0 100 10 5 5 0 000-10z" />
            </svg>
        </template>
    </div>
    <button @click="profileMenuOpen = !profileMenuOpen" class="flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md h-full">
        <img src="{{ Auth::user()->avatar }}" alt="Profile Photo" class="h-12 w-12 rounded-full object-cover border-2 border-indigo-500" />
        <span class="hidden sm:block text-gray-900 dark:text-gray-100">{{ \Illuminate\Support\Str::before(Auth::user()->email, '@') }}</span>
    </button>
    <!-- Profile dropdown -->
    <div x-show="profileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" @click.away="profileMenuOpen = false" class="absolute right-0 mt-12 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl py-2 z-50 ring-1 ring-black ring-opacity-5 focus:outline-none">
        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150">Edit Profile</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150">Logout</button>
        </form>
    </div>
</div>
</header>
