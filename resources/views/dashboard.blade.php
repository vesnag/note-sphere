<!-- resources/views/dashboard.blade.php -->

 @section('title', 'Dashboard')

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-dashboard :recentNotes="$recentNotes" :userCount="$userCount" title="User Dashboard" />
        </div>
    </div>
</x-app-layout>
