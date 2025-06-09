<x-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
        <h1 class="text-3xl font-bold mb-4 text-gray-900 dark:text-gray-100">{{ $note->title }}</h1>
        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $note->content }}</p>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">Created at: {{ $note->created_at->format('d M Y H:i') }}</p>
        <div class="mt-6 flex space-x-4">
            <a href="{{ route('notes.edit', $note) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Edit</a>
            <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this note?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Delete</button>
            </form>
            <a href="{{ route('notes.index') }}" class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-600 transition">Back to Notes</a>
        </div>
    </div>
</x-layout>
