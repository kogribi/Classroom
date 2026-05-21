<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Search --}}
            <form method="GET" action="{{ route('admin-panel') }}" class="flex gap-2">
                <input
                    type="text"
                    name="search"
                    placeholder="Search users..."
                    value="{{ request('search') }}"
                    class="flex-1 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                >
                <button
                    type="submit"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-150"
                >
                    Search
                </button>
            </form>

            {{-- Users list --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg divide-y divide-gray-100 dark:divide-gray-700">
                @foreach ($users as $user)
                    <form method="POST" action="{{ route('admin-panel') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="flex items-center justify-between px-6 py-4 gap-4">
                            <p class="text-gray-900 dark:text-gray-100 font-medium flex-1">
                                {{ $user->name }}
                            </p>

                            <select
                                name="role"
                                class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            >
                                <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                                <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Teacher</option>
                                <option value="admin"   {{ $user->role == 'admin'   ? 'selected' : '' }}>Admin</option>
                            </select>

                            <button
                                type="submit"
                                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-150"
                            >
                                Save
                            </button>
                        </div>
                    </form>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>