@extends('layouts.app')

@section('title', $note ? 'Edit Note' : 'Create Note')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16">
    <h1 class="text-3xl font-bold mb-6">
        {{ $note ? 'Edit Note' : 'Create New Note' }}
    </h1>

    <!-- Form for Creating or Editing a Note -->
    <form method="POST" action="{{ $note ? route('note.update', $note->id) : route('note.store') }}">
        @csrf
        @if ($note)
            @method('PUT')
        @endif

        <!-- Note Title Input -->
        <div class="mb-6">
            <label for="title" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Note Title</label>
            <input type="text" name="title" id="title" class="mt-1 block w-full px-3 py-2 border rounded-lg text-gray-900 dark:text-gray-900"
                   value="{{ $note ? $note->title : old('title') }}" required>
        </div>

        <!-- Note Content Textarea -->
        <div class="mb-6">
            <label for="content" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Content</label>
            <textarea name="content" id="content" rows="10" class="mt-1 block w-full px-3 py-2 border rounded-lg text-gray-900 dark:text-gray-900" required>{{ $note ? $note->content : old('content') }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-lavenderPurple hover:bg-deepLavender text-white px-4 py-2 rounded-lg">
                {{ $note ? 'Update Note' : 'Create Note' }}
            </button>
        </div>
    </form>
</div>
@endsection
