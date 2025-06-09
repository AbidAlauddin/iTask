<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @vite(['resources/css/app.css', 'resources/js/app.ts'])
    <title>@isset($title){{ $title }} -@endisset To Do App</title>
</head>

<body class="antialiased">
    <div class="flex min-h-screen bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-200">
        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Main content --}}
        <main class="flex-1 p-6 md:p-8 overflow-auto">
            {{ $slot }}
        </main>
        <x-header />
    </div>

    <script>
        let darkMode = localStorage.getItem('darkMode');
        const darkModeToggle = document.querySelector('#toggle');

        const enableDarkMode = () => {
            document.documentElement.classList.add('dark');
            localStorage.setItem('darkMode', 'enabled');
        };

        const disableDarkMode = () => {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('darkMode', null);
        };

        if (darkMode === 'enabled') {
            enableDarkMode();
        }

        darkModeToggle?.addEventListener('click', () => {
            darkMode = localStorage.getItem('darkMode');

            if (darkMode !== 'enabled') {
                enableDarkMode();
            } else {
                disableDarkMode();
            }
        });
    </script>
</body>

</html>
