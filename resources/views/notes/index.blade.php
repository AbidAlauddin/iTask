<x-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Notes</h1>
            <a href="{{ route('notes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Add Note</a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($notes->isEmpty())
            <p class="text-gray-600">No notes found. Start by adding a new note.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($notes as $note)
                    <div class="bg-white dark:bg-gray-800 rounded shadow p-4 flex flex-col justify-between">
                        <div>
                            <h2 class="text-xl font-semibold mb-2">{{ $note->title }}</h2>
                            <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $note->content }}</p>
                        </div>
                        <div class="mt-4 flex justify-between items-center text-sm text-gray-500 dark:text-gray-400">
                            <span>Created: {{ $note->created_at->format('d M Y H:i') }}</span>
                            <div class="space-x-2">
                                <a href="{{ route('notes.edit', $note) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('notes.destroy', $note) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this note?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
