<!-- resources/views/components/textarea.blade.php -->
@props(['rows' => 5])

<textarea {{ $attributes->merge(['class' => 'border-gray-300 w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }} rows="{{ $rows }}">
    {{ $slot }}
</textarea>
