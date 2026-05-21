<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create Homework
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('homework') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <input type="hidden" name="class_id" value="{{$classroom->id}}">
                    @error('class_id')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Title
                        </label>
                        <input
                            id="title"
                            name="title"
                            type="text"
                            value="{{ old('title') }}"
                            placeholder="e.g. Study"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        >
                        @error('title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Description
                        </label>
                        <input
                            id="description"
                            name="description"
                            type="text"
                            value="{{ old('description') }}"
                            placeholder="A short description of the homework"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        >
                        @error('description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Homework File
                        </label>

                        <div id="files">
                            <input
                                type="file"
                                name="file[]"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                            >
                        </div>

                        <button type="button" onclick="addFileInput()" class="mt-3 py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg">
                            Add another file
                        </button>

                        <script>
                        function addFileInput() {
                            const div = document.getElementById('files');

                            const input = document.createElement('input');
                            input.type = 'file';
                            input.name = 'file[]';
                            input.className = "w-full px-4 py-2 mt-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100";

                            div.appendChild(input);
                        }
                        </script>

                        @error('file')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Due date
                        </label>
                        <input
                            id="due_date"
                            name="due_date"
                            type="date"
                            value="{{ old('due_date') }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        >
                        @error('due_date')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-150"
                    >
                        Create Homework
                    </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>