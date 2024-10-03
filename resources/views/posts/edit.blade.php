<!-- resources/views/posts/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Post Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title</label>
                            <x-text-input class="block mt-1 w-full" type="text" name="title" id="title" value="{{ $post->title }}" required />
                        </div>

                        <!-- Post Content -->
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Content</label>
                            <x-textarea id="content" name="content" rows="5" required>{{ $post->content }}</x-textarea>
                        </div>

                        <!-- Update Button -->
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-block px-4 py-2 text-sm font-medium text-white bg-yellow-500 rounded-md shadow hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                                {{ __('Update Post') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
