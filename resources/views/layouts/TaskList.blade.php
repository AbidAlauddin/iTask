@auth
<nav class="flex justify-between max-w-full mb-16" aria-label="user navigation">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <ul class="flex flex-col sm:flex sm:flex-row sm:justify-center">
        <li class="py-1 sm:pr-2 sm:pt-1 sm:pl-0 sm:py-2 border-transparent border-b-2 hover:border-b-2 hover:border-slate-200">
            <a href="{{ route('lists.index') }}">Lists</a>
        </li>
        <li class="py-1 sm:px-2 sm:pt-1 sm:py-2 border-transparent border-b-2 hover:border-b-2 hover:border-slate-200">
            <a href="{{ route('my-day') }}">My Day</a>
        </li>
        <li class="py-1 sm:pl-2 sm:pt-1 sm:py-2 border-transparent border-b-2 hover:border-b-2 hover:border-slate-200">
            <a href="{{ route('all-task') }}">All tasks</a>
        </li>
    </ul>
    <ul class="flex flex-col sm:flex sm:flex-row sm:justify-center text-right ">
        <li class="flex items-center sm:pb-2 border-transparent border-b-2 hover:border-b-2 hover:border-slate-200">
            <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->avatar }}">
            <a href="{{ route('profile.edit') }}" class="pr-0 pl-1 ">Profile</a>
        </li>
        <li class="mt-1 pr-0 sm:mt-0 sm:pt-1 sm:pl-4 sm:py-2 border-transparent border-b-2 hover:border-b-2 hover:border-slate-200">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="">Log out</button>
            </form>
        </li>
    </ul>
</nav>
@endauth
