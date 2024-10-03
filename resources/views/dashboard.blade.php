<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Welcome to Our Portal') }}
        </h2>
    </x-slot>

    {{-- <!-- Hero Section -->
    <div class="bg-cover bg-center h-screen" style="background-image: url('https://source.unsplash.com/random/1920x1080');">
        <div class="flex justify-center items-center h-full bg-black bg-opacity-50">
            <div class="text-center">
                <h1 class="text-white text-5xl font-bold mb-4">Welcome to Our Portal</h1>
                <p class="text-white text-xl mb-6">Your one-stop solution for managing all your needs efficiently and effortlessly.</p>
                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full shadow-lg transition duration-300">Get Started</a>
            </div>
        </div>
    </div> --}}

    <!-- About Section -->
    <div class="container mx-auto py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-6">About This Portal</h2>
            <p class="text-gray-600 dark:text-gray-300 text-lg mb-4">
                This portal is designed to simplify your tasks, whether you're an admin managing users and content, or a regular user looking to engage with our services. 
                With features like user management, content management, and real-time updates, you’ll have everything you need at your fingertips.
            </p>
            <p class="text-gray-600 dark:text-gray-300 text-lg">
                You can easily navigate through the platform, manage your profile, and get instant updates on the latest posts and activities. We ensure that every user has a smooth 
                and secure experience, with a focus on ease of use and efficiency.
            </p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-900 py-6 mt-12">
        <div class="container mx-auto text-center">
            <p class="text-gray-600 dark:text-gray-400 text-sm">&copy; 2024 Our Portal. All rights reserved.</p>
        </div>
    </footer>

</x-app-layout>
