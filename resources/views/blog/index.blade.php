<!-- resources/views/blog/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Blog Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Loop through all posts -->
            @foreach ($posts as $post)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-xl font-bold">{{ $post->title }}</h3>
                        <p>{{ Str::limit($post->content, 200) }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">By {{ $post->user->name }} on {{ $post->created_at->format('F j, Y') }}</p>

                        <!-- Link to the full post -->
                        <a href="{{ route('blog.show', $post->id) }}" class="text-indigo-500 hover:underline mt-2 block">Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
