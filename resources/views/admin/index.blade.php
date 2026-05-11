<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="GET" action="{{ route('admin-panel') }}">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search..."
                        value="{{ request('search') }}"
                        class="border rounded px-3 py-2"
                    >

                    <button type="submit" class="text-gray-900 dark:text-gray-100">
                        Search
                    </button>
                </form>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                            @foreach ($users as $user)
                                <form method="POST" action="{{ route('admin-panel') }}">
                                     @csrf
                                <div class="flex p-2 gap-4 items-center">
                                    <p>{{ $user->name }}</p> 

                                    <input type="hidden" name="user_id" value="{{ $user->id }}">


                                    <select name="role" class="text-gray-900 dark:text-black-100">
                                        <option value="student" class="text-gray-900 dark:text-black-100" {{ $user->role == 'student' ? 'selected' : '' }}>
                                            Student
                                        </option>
                                        <option value="teacher" class="text-gray-900 dark:text-black-100" {{ $user->role == 'teacher' ? 'selected' : '' }}>
                                            Teacher
                                        </option>
                                        <option value="admin" class="text-gray-900 dark:text-black-100" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>
                                    </select>


                                    <button type="submit" class="text-gray-900 dark:text-gray-100">
                                        Submit
                                    </button>
                                </div>
                                </form>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
