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
    <div class="bg-white text-slate-700 dark:text-slate-200 min-h-screen dark:bg-slate-900">
            <div class="font-sans max-w-3xl mx-auto p-6 md:p-8">
            <img id="logo" class="mx-auto w-auto" src="{{ asset('images/Logo.png') }}" alt="Your Logo" style="height: 200px;" />

            {{-- Dark mode toggle --}}
            <div class="flex justify-center items-center space-x-2 mb-16">
                <span class="text-sm text-gray-800 dark:text-gray-500">Light</span>
                <label for="toggle" class="w-9 h-5 flex items-center bg-gray-300 rounded-full p-1 cursor-pointer duration-300 ease-in-out">
                    <div class="toggle-dot bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out dark:translate-x-3"></div>
                </label>
                <span class="text-sm text-gray-400 dark:text-white">Dark</span>
                <input id="toggle" type="checkbox" class="hidden" />
            </div>

            <h2 class="text-lg text-center mb-1">Simple to-do app</h2>

            <nav class="mx-auto max-w-full mb-6 sm:py-4" aria-label="guest navigation">
                <ul class="flex justify-center">
                    <li class="p-2 border-transparent border-b-2 hover:border-b-2 hover:border-slate-200">
                        <a href="{{ route('login') }}" class="p-2">Login</a>
                    </li>
                    <li class="p-2 border-transparent border-b-2 hover:border-b-2 hover:border-slate-200">
                        <a href="{{ route('register') }}" class="p-2">Register</a>
                    </li>
                </ul>
            </nav>

            {{ $slot }}
            
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

                darkModeToggle.addEventListener('click', () => {
                    darkMode = localStorage.getItem('darkMode');

                    if (darkMode !== 'enabled') {
                        enableDarkMode();
                    } else {
                        disableDarkMode();
                    }
                    updateLogo();
                });

                function updateLogo() {
                    const logo = document.getElementById('logo');
                    // Cek mode dark saat ini
                    const isDark = document.documentElement.classList.contains('dark');
                    if (isDark) {
                        logo.src = "{{ asset('images/Logo2.png') }}";
                    } else {
                        logo.src = "{{ asset('images/Logo.png') }}";
                    }
                }

                // Update logo saat halaman load berdasarkan mode sistem atau localStorage
                document.addEventListener('DOMContentLoaded', () => {
                    updateLogo();
                });
            </script>
        </div>
    </div>
</body>

</html>
