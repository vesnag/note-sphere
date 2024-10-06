<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $note ? 'Edit Note' : 'Create Note' }}
        </h2>
    </x-slot>

    @section('title', $note ? 'Edit Note' : 'Create Note')

    <x-note-editor :note="$note" />
</x-app-layout>
