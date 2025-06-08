<x-layout title="Edit Profile">
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-8 dark:text-slate-200">Edit Your Profile</h1>
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column: Avatar and User Info -->
            <div class="flex flex-col items-center border-r border-gray-200 dark:border-gray-700 pr-6">
                <img src="{{ $user->avatar ?? '/uploads/user-avatar.webp' }}" alt="Your avatar" class="w-40 h-40 rounded-full object-cover mb-6 shadow-md">
                <h2 class="text-xl font-semibold mb-2 text-center text-gray-800 dark:text-slate-200">{{ $user->name ?? 'User' }}</h2>
                <ul class="text-center text-gray-600 dark:text-slate-400 space-y-2 text-sm">
                    <li><span class="font-semibold">Email:</span> {{ $user->email }}</li>
                    <li><span class="font-semibold">Joined:</span> {{ $user->created_at->diffForHumans() }}</li>
                    <li><span class="font-semibold">Last updated:</span> {{ $user->updated_at->diffForHumans() }}</li>
                </ul>
            </div>

            <!-- Right Column: Forms -->
            <div class="md:col-span-2 space-y-10">
                <!-- Update Profile Info -->
                <section class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow-inner">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-900 dark:text-slate-200 text-center">Update Profile Info</h2>
                    <form action="{{ route('profile.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label for="avatar" class="block mb-2 font-medium text-gray-700 dark:text-slate-300">Avatar</label>
                            <input type="file" name="avatar" id="avatar" 
                                class="w-full rounded border border-gray-300 dark:border-gray-600 p-2 text-gray-700 dark:text-slate-200 bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200" />
                            @error('avatar')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 dark:text-slate-400 mt-1">Max size: 2 MB.</p>
                        </div>
                        <div>
                            <label for="email" class="block mb-2 font-medium text-gray-700 dark:text-slate-300">Email</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" required
                                class="w-full rounded border border-gray-300 dark:border-gray-600 p-4 text-gray-900 dark:text-slate-200 bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200 @error('email') border-red-500 @enderror" />
                            @error('email')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" name="update_user" 
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded transition duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Save Profile Info
                        </button>
                    </form>
                </section>

                <!-- Update Password -->
                <section class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow-inner">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-900 dark:text-slate-200 text-center">Update Password</h2>
                    <form action="{{ route('profile.changepassword', $user) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="current_password" class="block mb-2 font-medium text-gray-700 dark:text-slate-300">Current Password</label>
                            <input type="password" name="current_password" id="current_password" required
                                class="w-full rounded border border-gray-300 dark:border-gray-600 p-4 text-gray-900 dark:text-slate-200 bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200 @error('current_password') border-red-500 @enderror" />
                            @error('current_password')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="new_password" class="block mb-2 font-medium text-gray-700 dark:text-slate-300">New Password</label>
                            <input type="password" name="new_password" id="new_password" required
                                class="w-full rounded border border-gray-300 dark:border-gray-600 p-4 text-gray-900 dark:text-slate-200 bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200 @error('new_password') border-red-500 @enderror" />
                            @error('new_password')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="new_password_confirm" class="block mb-2 font-medium text-gray-700 dark:text-slate-300">Confirm New Password</label>
                            <input type="password" name="new_password_confirm" id="new_password_confirm" required
                                class="w-full rounded border border-gray-300 dark:border-gray-600 p-4 text-gray-900 dark:text-slate-200 bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200 @error('new_password_confirm') border-red-500 @enderror" />
                            @error('new_password_confirm')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" name="change_password" 
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded transition duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Save Password
                        </button>
                    </form>
                </section>

                <!-- Delete Account -->
                <section class="bg-red-50 dark:bg-red-900 rounded-lg p-6 shadow-inner">
                    <h2 class="text-2xl font-semibold mb-6 text-red-700 dark:text-red-400 text-center">Delete Account</h2>
                    @can('delete', $user)
                    <form action="{{ route('profile.destroy', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Confirm, do you want to delete your account and its data (you will not be able to retrieve it if you change your mind).')" 
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded transition duration-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            Delete Account
                        </button>
                    </form>
                    @endcan
                </section>
            </div>
        </div>
    </div>
</x-layout>
