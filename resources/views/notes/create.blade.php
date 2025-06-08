<x-layout>
    <div class="container mx-auto px-4 py-6 max-w-lg">
        <h1 class="text-3xl font-bold mb-6">Add New Note</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('notes.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="title" class="block font-semibold mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label for="content" class="block font-semibold mb-1">Content</label>
                <textarea name="content" id="content" rows="6" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('content') }}</textarea>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('notes.index') }}" class="text-gray-600 hover:underline">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Save</button>
            </div>
        </form>
    </div>
</x-layout>
