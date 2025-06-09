<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @vite(['resources/css/app.css', 'resources/js/app.ts'])
    <title>@isset($title){{ $title }} -@endisset To Do App</title>
    <style>
        #sun,
        #moon,
        .star {
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        #sun.hidden,
        #moon.hidden,
        .star.hidden {
            opacity: 0;
            visibility: hidden;
        }

        #sun:not(.hidden),
        #moon:not(.hidden),
        .star:not(.hidden) {
            opacity: 1;
            visibility: visible;
        }

        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: white;
            border-radius: 50%;
        }

        /* Styling awan */
        .cloud {
            position: absolute;
            background: white;
            background: linear-gradient(135deg, #fff, #e0e0e0);
            border-radius: 50%;
            filter: drop-shadow(0 0 4px rgba(0, 0, 0, 0.1));
            opacity: 0.9;
            transition: opacity 0.5s ease;
        }

        .cloud::before,
        .cloud::after {
            content: '';
            position: absolute;
            background: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            top: -30px;
            left: 10px;
            background: linear-gradient(135deg, #fff, #e0e0e0);
        }

        .cloud::after {
            width: 80px;
            height: 80px;
            top: -50px;
            left: 40px;
        }
    </style>
</head>

<body class="antialiased relative">
    {{-- BACKGROUND START --}}
    <div class="fixed inset-0 -z-10 transition-all duration-500 bg-gradient-to-b from-blue-400 to-blue-100 dark:from-slate-800 dark:to-gray-900" id="background">

        <!-- Stars for dark mode -->
        <div class="star" style="top: 5%; left: 10%;"></div>
        <div class="star" style="top: 15%; left: 25%;"></div>
        <div class="star" style="top: 8%; left: 40%;"></div>
        <div class="star" style="top: 20%; left: 60%;"></div>
        <div class="star" style="top: 12%; left: 75%;"></div>
        <div class="star hidden" style="top: 18%; left: 85%;"></div>

        <!-- AWAN hanya muncul di LIGHT MODE -->
        <div class="cloud dark:hidden" style="top: 25%; left: 15%; width: 120px; height: 60px;"></div>
        <div class="cloud dark:hidden" style="top: 35%; left: 50%; width: 150px; height: 75px;"></div>
        <div class="cloud dark:hidden" style="top: 15%; left: 75%; width: 100px; height: 50px;"></div>

        <!-- Matahari tampil default dengan efek siang -->
        <div id="sun" class="absolute top-10 right-10 w-24 h-24 rounded-full bg-yellow-300 shadow-[0_0_80px_30px_rgba(255,223,0,0.8)] transition-all duration-500 z-20"></div>
        <!-- Bulan tampil di dark mode -->
        <div id="moon" class="absolute top-10 right-10 w-20 h-20 rounded-full bg-yellow-200 shadow-[0_0_40px_15px_rgba(255,255,200,0.3)] hidden transition-all duration-500 z-20"></div>
    </div>
    {{-- BACKGROUND END --}}

    <div class="text-slate-700 dark:text-slate-200 min-h-screen dark:bg-transparent">
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
                const html = document.documentElement;
                const sun = document.getElementById('sun');
                const moon = document.getElementById('moon');
                const stars = document.querySelectorAll('.star');

                const enableDarkMode = () => {
                    html.classList.add('dark');
                    localStorage.setItem('darkMode', 'enabled');
                    sun.classList.add('hidden');
                    moon.classList.remove('hidden');
                    stars.forEach(star => star.classList.remove('hidden'));
                };

                const disableDarkMode = () => {
                    html.classList.remove('dark');
                    localStorage.setItem('darkMode', null);
                    sun.classList.remove('hidden');
                    moon.classList.add('hidden');
                    stars.forEach(star => star.classList.add('hidden'));
                };

                function updateLogo() {
                    const logo = document.getElementById('logo');
                    const isDark = html.classList.contains('dark');
                    logo.src = isDark
                        ? "{{ asset('images/Logo2.png') }}"
                        : "{{ asset('images/Logo gelap.png') }}";
                }

                document.addEventListener('DOMContentLoaded', () => {
                    const isDark = darkMode === 'enabled';
                    if (isDark) {
                        enableDarkMode();
                        darkModeToggle.checked = true;
                    } else {
                        disableDarkMode();
                    }
                    updateLogo();
                });

                darkModeToggle.addEventListener('click', () => {
                    darkMode = localStorage.getItem('darkMode');
                    if (darkMode !== 'enabled') {
                        enableDarkMode();
                    } else {
                        disableDarkMode();
                    }
                    updateLogo();
                });
            </script>
        </div>
    </div>
</body>

</html>