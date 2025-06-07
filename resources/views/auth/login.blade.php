<x-layout-auth title="Login">
    <div class="flex min-h-full flex-col justify-center px-6 py-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-6 text-center text-2xl/9 font-bold tracking-tight text-gray-900 dark:text-gray-200">Sign in to your account</h2>
        </div>

        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm">

            {{-- STATUS & ERROR FEEDBACK --}}
            @if (session('status'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4 text-sm text-center">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-4 text-sm text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- FORM LOGIN --}}
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf

                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900 dark:text-gray-200">Email address</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email" autocomplete="email" value="{{ old('email') }}" required class="block w-full rounded-md bg-white dark:bg-slate-900 px-3 py-1.5 text-base text-gray-900 dark:text-gray-200 outline outline-1 -outline-offset-1 outline-gray-300 dark:outline-gray-600 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900 dark:text-gray-200">Password</label>
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white dark:bg-slate-900 px-3 py-1.5 text-base text-gray-900 dark:text-gray-200 outline outline-1 -outline-offset-1 outline-gray-300 dark:outline-gray-600 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    <label for="remember" class="ml-2 block text-sm text-gray-900 dark:text-gray-200">Remember me</label>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Sign in
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-500 dark:text-gray-400">
                Not a member?
                <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Register now</a>
            </p>
        </div>
    </div>
</x-layout-auth>