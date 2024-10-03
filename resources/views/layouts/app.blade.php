<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
        @if (session('success'))
            <div id="successAlert"
                class="bg-green-500 text-white p-4 rounded-md shadow-md mb-4 transition-opacity duration-1000 ease-out">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div id="errorAlert"
                class="bg-red-500 text-white p-4 rounded-md shadow-md mb-4 transition-opacity duration-1000 ease-out">
                {{ session('error') }}
            </div>
        @endif


        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
<!-- Add the JavaScript script at the bottom of the Blade template -->
<script>
    // Auto hide success and error alerts after 5 seconds
    setTimeout(function() {
        let successAlert = document.getElementById('successAlert');
        if (successAlert) {
            successAlert.style.opacity = 0;
            setTimeout(() => successAlert.style.display = 'none', 1000); // Hide completely after fade out
        }

        let errorAlert = document.getElementById('errorAlert');
        if (errorAlert) {
            errorAlert.style.opacity = 0;
            setTimeout(() => errorAlert.style.display = 'none', 1000); // Hide completely after fade out
        }
    }, 2000); // 5 seconds delay before hiding
</script>

</html>

<!-- resources/views/layouts/app.blade.php -->
