<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Display the total count of users and posts -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">Dashboard Overview</h3>
                        <p>Total Users: <strong>{{ $userCount }}</strong></p>
                        <p>Total Posts: <strong>{{ $postCount }}</strong></p>
                    </div>

                    <!-- Display list of all users with post count -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">All Users</h3>
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Email</th>
                                    <th class="px-4 py-2">Total Posts</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $user->name }}</td>
                                        <td class="border px-4 py-2">{{ $user->email }}</td>
                                        <td class="border px-4 py-2">{{ $user->posts_count }}</td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Display list of all posts with creator, comment count, and commenters -->
                    <div>
                        <h3 class="text-lg font-semibold">All Posts</h3>
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Title</th>
                                    <th class="px-4 py-2">Created By</th>
                                    <th class="px-4 py-2">Comments Count</th>
                                    <th class="px-4 py-2">Commenters</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $post->title }}</td>
                                        <td class="border px-4 py-2">{{ $post->user->name ?? 'Unknown' }}</td>
                                        <td class="border px-4 py-2">{{ $post->comments->count() }}</td>
                                        <td class="border px-4 py-2">
                                            <!-- Loop through each comment and show the user's name with hover modal for comments -->
                                            @foreach ($post->comments as $comment)
                                                <div class="relative group inline-block">
                                                    <!-- Name of commenter -->
                                                    <span class="text-blue-600 hover:underline cursor-pointer">
                                                        {{ $comment->user->name ?? 'Unknown' }}
                                                    </span>

                                                    <!-- Floating Modal for Comments -->
                                                    <div class="absolute z-10 hidden group-hover:block bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 border border-gray-300 rounded-md p-3 w-64 shadow-lg">
                                                        <p class="text-sm">Comment: {{ $comment->content }}</p>
                                                        <p class="text-xs text-gray-500">Posted on {{ $comment->created_at->format('F j, Y') }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="bg-blue-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br> <br> 
            </div>
          
        </div>
    </div>
</x-app-layout>
