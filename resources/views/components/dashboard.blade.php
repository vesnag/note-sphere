<!-- resources/views/components/dashboard.blade.php -->

<div class="container mx-auto p-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Recent Notes -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Recent Notes</h2>
            <ul class="space-y-2">
                @foreach($recentNotes as $note)
                    <li class="pb-2">
                        <a href="{{ route('note.show.single', $note->id) }}" class="text-blue-600 dark:text-blue-400">{{ $note->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
