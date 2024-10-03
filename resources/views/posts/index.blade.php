<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Manage Your Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12">
        <div class="bg-gray-900 text-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <!-- Display Active Posts (of logged-in user only) -->
            <h3 class="text-2xl font-semibold mb-4">Your Active Posts</h3>
            @if ($posts->count())
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border border-white px-4 py-2">Title</th>
                            <th class="border border-white px-4 py-2">Status</th>
                            <th class="border border-white px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td class="border border-white px-4 py-2">{{ $post->title }}</td>
                                <td class="border border-white px-4 py-2">
                                    @if($post->trashed())
                                        <span class="text-red-500">Deleted</span>
                                    @else
                                        <span class="text-green-500">Active</span>
                                    @endif
                                </td>
                                <td class="border border-white px-4 py-2">
                                    @if($post->trashed())
                                        <!-- Restore button for soft-deleted posts -->
                                        <a href="{{ route('posts.restore', $post->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Restore</a> |
                                        <a href="{{ route('posts.forceDelete', $post->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">Force Delete</a>
                                    @else
                                        <a href="{{ route('posts.edit', $post->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a> |
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-white">No posts available.</p>
            @endif

            <!-- Display Trashed Posts (of logged-in user only) -->
            <h3 class="text-2xl font-semibold mb-4">Your Trashed Posts</h3>
            @if($trashedPosts->count())
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border border-white px-4 py-2">Title</th>
                            <th class="border border-white px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trashedPosts as $post)
                            <tr>
                                <td class="border border-white px-4 py-2">{{ $post->title }}</td>
                                <td class="border border-white px-4 py-2">
                                    <!-- Restore Post -->
                                    <a href="{{ route('posts.restore', $post->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Restore</a> |
                                    <!-- Force Delete Post -->
                                    <a href="{{ route('posts.forceDelete', $post->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to permanently delete this post?')">Force Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-white">You have no trashed posts.</p>
            @endif
        </div>
    </div>
</x-app-layout>
