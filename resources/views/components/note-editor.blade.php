<div class="container mx-auto px-4 py-8 mt-10">
    <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">
        {{ $note ? 'Edit Note' : 'Create New Note' }}
    </h1>

    <!-- Notification Container -->
    <div id="notification-container" class="hidden bg-lightPink border border-royalPurple text-darkPurple px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline" id="notification-message"></span>
        <div class="mt-4">
            <button id="accept-update" class="bg-lavenderPurple hover:bg-deepLavender text-white font-bold py-2 px-4 rounded mr-2">Accept</button>
            <button id="skip-update" class="bg-darkPurple hover:bg-violet text-white font-bold py-2 px-4 rounded">Skip</button>
        </div>
    </div>

    <div class="flex">
        <!-- Form for Creating or Editing a Note -->
        <div class="w-2/3 pr-4">
            <form method="POST" action="{{ $note ? route('note.update', $note->id) : route('note.store') }}">
                @csrf
                @if ($note)
                    @method('PUT')
                @endif

                <!-- Note Title Input -->
                <div class="mb-6">
                    <label for="title" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Note Title</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full px-3 py-2 border rounded-lg text-gray-900 dark:text-gray-100 dark:bg-gray-700 dark:border-gray-600"
                           value="{{ $note ? $note->title : old('title') }}" required readonly>
                </div>

                <!-- Note Content Textarea -->
                <div class="mb-6">
                    <label for="content" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Content</label>
                    <textarea name="content" id="note-content" rows="10" class="mt-1 block w-full px-3 py-2 border rounded-lg text-gray-900 dark:text-gray-100 dark:bg-gray-700 dark:border-gray-600" required>{{ $note ? $note->content : old('content') }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-[#9151b0] hover:bg-[#7260c3] text-white px-4 py-2 rounded-lg">
                        {{ $note ? 'Update Note' : 'Create Note' }}
                    </button>
                </div>
            </form>
        </div>

        @if(isset($note))
        <!-- Users Online Information -->
        <div class="w-1/3 pl-4">
            <div id="users-list-container" class="shadow rounded-lg p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Currently Online</h2>
                <ul id="users-list" class="space-y-2"></ul>
            </div>
        </div>
        @endif
    </div>
</div>
