<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.ts'])
    <title>@isset($title){{ $title }} -@endisset To Do App</title>
</head>

<body class="antialiased" x-data="{ sidebarOpen: true }" @toggle-sidebar.window="sidebarOpen = !sidebarOpen">
    <div class="flex min-h-screen bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-200">
        <x-sidebar x-bind:class="sidebarOpen ? 'w-64' : 'w-16'" x-bind:style="sidebarOpen ? '' : 'min-width: 4rem; max-width: 4rem;'" />
        <div class="flex flex-col flex-1 overflow-auto pt-20">
            <x-header />
            <main class="flex-1 p-6 md:p-8 overflow-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
    <x-flash />
    <script>
        let darkMode = localStorage.getItem('darkMode');
        const darkModeToggle = document.querySelector('#toggle');
        const toggleDot = document.getElementById('toggle-dot');

        // Set initial checkbox state and toggle dot position based on localStorage
        if (darkMode === 'enabled') {
            darkModeToggle.checked = true;
            toggleDot.classList.add('translate-x-3');
            document.documentElement.classList.add('dark');
        } else {
            darkModeToggle.checked = false;
            toggleDot.classList.remove('translate-x-3');
            document.documentElement.classList.remove('dark');
        }

        darkModeToggle.addEventListener('click', () => {
            darkMode = localStorage.getItem('darkMode');

            if (darkMode !== 'enabled') {
                enableDarkMode();
                toggleDot.classList.add('translate-x-3');
            } else {
                disableDarkMode();
                toggleDot.classList.remove('translate-x-3');
            }
        });

        // Add click event on label to toggle checkbox and trigger dark mode toggle
        const toggleLabel = document.getElementById('toggle-label');
        toggleLabel.addEventListener('click', () => {
            darkModeToggle.checked = !darkModeToggle.checked;
            darkModeToggle.dispatchEvent(new Event('click'));
        });

        function enableDarkMode() {
            document.documentElement.classList.add('dark');
            localStorage.setItem('darkMode', 'enabled');
        }

        function disableDarkMode() {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('darkMode', null);
        }
    </script>
</body>

</html>
