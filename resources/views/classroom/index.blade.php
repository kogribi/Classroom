<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-4">
            {{ __('Classes') }}
            @can('teacher')
            <a href="{{ route('create_class') }}">
                <button class="inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 dark:hover:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    + Create a Class
                </button>
            </a>
            @endcan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($classes->isEmpty())
            <div class="text-center py-20 text-gray-400 dark:text-gray-500">
                <svg class="mx-auto mb-4 w-12 h-12 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                </svg>
                <p class="text-lg font-medium">No classes yet.</p>
                <p class="text-sm mt-1">Check back later or join one.</p>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($classes as $class)
                <a href="classes/{{ $class->id }}" class="group block contents">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-lg dark:shadow-gray-900 border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:-translate-y-1 cursor-pointer">

                    {{-- Banner image --}}
                    <div class="relative h-40 bg-gradient-to-br from-indigo-400 via-purple-400 to-pink-400 dark:from-indigo-700 dark:via-purple-800 dark:to-pink-800 overflow-hidden">
                        @if(!empty($class->banner))
                            <img
                                src="{{ $class->banner }}"
                                alt="{{ $class->name }} banner"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        @else
                            {{-- Placeholder pattern when no banner --}}
                            <div class="absolute inset-0 opacity-20">
                                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <pattern id="grid-{{$class->id}}" width="24" height="24" patternUnits="userSpaceOnUse">
                                            <path d="M 24 0 L 0 0 0 24" fill="none" stroke="white" stroke-width="1"/>
                                        </pattern>
                                    </defs>
                                    <rect width="100%" height="100%" fill="url(#grid-{{$class->id}})" />
                                </svg>
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-14 h-14 text-white opacity-60" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.966 8.966 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Card body --}}
                    <div class="p-5">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 leading-snug mb-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-200">
                            {{ $class->name }}
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 leading-relaxed">
                            {{ $class->description ?? 'No description provided.' }}
                        </p>

                        <div class="mt-4 flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 px-2.5 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 dark:bg-indigo-400"></span>
                                Active
                            </span>
                            <a href="#" class="text-xs font-semibold text-gray-400 dark:text-gray-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-150 flex items-center gap-1">
                                View
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                </a>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</x-app-layout>