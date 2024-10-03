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
                    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ $post->title }}" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:bg-gray-900 dark:text-gray-100">
                        </div>

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
