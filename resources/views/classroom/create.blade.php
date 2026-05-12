<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Classes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('classes') }}" class="text-gray-900 dark:text-gray-100">
                    @csrf
                    <input type="hidden" class="text-gray-900 dark:text-black-100" name="user_id" value="{{ Auth::user()->id }}">
                    name
                    @error('user_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <input name="name" class="text-gray-900 dark:text-black-100" value="{{ old('name') }}">
                    @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <br>
                    description
                    <input name="description" class="text-gray-900 dark:text-black-100" value="{{ old('description') }}">
                    @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <button type="submit" >
                        Submit
                    </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>