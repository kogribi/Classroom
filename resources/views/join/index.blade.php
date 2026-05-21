<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Join a class') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-8">

                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-6">
                    Enter your class code
                </h3>

                <form method="POST" action="{{ route('join') }}" class="space-y-5">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    @error('user_id')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Code
                        </label>
                        <input
                            id="code"
                            name="code"
                            type="text"
                            value="{{ old('code') }}"
                            placeholder="e.g. ABC123"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        >
                        @error('code')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-150"
                    >
                        Join Class
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>