<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4">
    <div class="text-center">

        @auth
            <div class="flex justify-center mb-8">
                <x-new-note-button />
            </div>
        @endauth


        @guest
            <!-- Logo -->
            <div class="mb-6">
                <a href="/" class="flex items-center justify-center">
                    <x-logo class="w-24 h-24" />
                </a>
            </div>
            <!-- Welcome Text -->
            <h1 class="text-5xl font-bold text-darkPurple mb-4 sm:text-4xl md:text-5xl">Welcome to NoteSphere</h1>
            <p class="text-xl text-gray-700 dark:text-gray-300 mb-8 sm:text-lg md:text-xl">Your personal note-taking application.</p>

            <!-- Action Buttons -->
            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="bg-lavenderPurple hover:bg-deepLavender dark:bg-lavenderPurple dark:hover:bg-deepLavender text-white px-6 py-3 rounded-full text-lg transition duration-300">Login</a>
                <a href="{{ route('register') }}" class="bg-royalPurple hover:bg-darkPurple dark:bg-royalPurple dark:hover:bg-darkPurple text-white px-6 py-3 rounded-full text-lg transition duration-300">Register</a>
            </div>
        @endguest
    </div>
</div>
@endsection
