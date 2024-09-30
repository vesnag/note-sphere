<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoteSphere - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex flex-col min-h-screen">
     <!-- Header -->
    <header class="bg-gray-800 dark:bg-gray-800 text-white fixed w-full top-0 z-10 shadow">
        <div class="container mx-auto flex justify-between items-center p-4">
            <!-- Logo -->
            <div class="text-2xl font-bold">
                <a href="/" class="flex items-center">
                    <x-logo class="w-12 h-12" />
                    <span class="ml-2">NoteSphere</span>
                </a>
            </div>
            <!-- Navigation -->
            <nav class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="bg-lavenderPurple hover:bg-deepLavender text-white px-4 py-2 rounded transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-royalPurple hover:bg-darkPurple text-white px-4 py-2 rounded transition">Register</a>
                @else
                    <a href="{{ route('dashboard') }}" class="hover:text-lightPink transition">Dashboard</a>
                    <a href="{{ route('profile') }}" class="hover:text-lightPink transition">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-deepLavender hover:bg-royalPurple text-white px-4 py-2 rounded transition">Logout</button>
                    </form>
                @endguest
                <!-- Theme Toggle Button -->
                <button id="theme-toggle" type="button"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow mt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 dark:bg-gray-800 text-white mt-8">
        <div class="container mx-auto py-4 text-center">
            <p class="text-sm">&copy; {{ date('Y') }} NoteSphere. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
