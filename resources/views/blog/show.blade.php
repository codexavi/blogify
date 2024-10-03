<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Post Content -->
                    <p>{{ $post->content }}</p>

                    <!-- Display Comments -->
                    <h3 class="mt-8 text-lg font-semibold">Comments</h3>
                    @foreach ($post->comments as $comment)
    <div class="bg-gray-100 dark:bg-gray-900 p-4 mt-4 rounded-lg">
        <!-- If the comment is being edited, show the form -->
        @if (session('edit_comment_id') == $comment->id)
            <!-- Edit Comment Form -->
            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <textarea name="content" rows="3" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('content', $comment->content) }}</textarea>
                <button type="submit" class="mt-2 px-4 py-2 bg-green-600 text-white rounded-md shadow-sm hover:bg-green-700">Save</button>
                <a href="{{ route('blog.show', $post->id) }}" class="mt-2 px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Cancel</a>
            </form>
        @else
            <!-- Display the comment normally -->
            <p>{{ $comment->content }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">By {{ $comment->user->name ?? 'Unknown' }} on {{ $comment->created_at->format('F j, Y') }}</p>

            <!-- Show Edit and Delete buttons only for the comment owner -->
            @if (auth()->id() === $comment->user_id)
                <a href="{{ route('blog.show', ['post' => $post->id, 'edit' => $comment->id]) }}" class="text-blue-600 hover:underline">Edit</a>

                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                </form>
            @endif
        @endif
    </div>
@endforeach

                    <!-- Add New Comment -->
                    @auth
                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-8">
                            @csrf
                            <textarea name="content" rows="4" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Add a comment..." required></textarea>
                            <button type="submit" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">Submit</button>
                        </form>
                    @else
                        <p class="mt-4">Please <a href="{{ route('login') }}" class="text-indigo-500 hover:underline">log in</a> to leave a comment.</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
