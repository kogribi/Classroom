<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight font-serif">
            {{ $classroom->name }}
            
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">

                {{-- Description --}}
                <div class="px-7 py-5 border-b border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                    {{ $classroom->description }}
                </div>

                {{-- Class Code --}}
                @if($classroom->user_id === auth()->id())
                <div class="px-7 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-widest">Class code</span>
                    <span class="font-mono text-sm font-semibold tracking-widest px-3 py-1.5 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 select-all">
                        {{ $classroom->code }}
                    </span>
                </div>
                @endif

                {{-- Content --}}
                <div class="px-7 py-6">

                    {{-- Add Homework Button --}}
                    @if($classroom->user_id === auth()->id())
                    <form method="GET" action="{{ route('create_homework') }}">
                        <input type="hidden" name="class_id" value="{{ $classroom->id }}">

                        @error('class_id')
                            <p class="text-sm text-red-500 mb-2">{{ $message }}</p>
                        @enderror

                        <button
                            type="submit"
                            class="w-full flex items-center justify-center gap-2 py-2.5 px-4 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-medium rounded-lg transition-colors duration-150 mb-6"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5v14M5 12h14"/>
                            </svg>
                            Add homework
                        </button>
                    </form>
                    @endif
                    {{-- Homework List --}}
                    @forelse($classroom->homeworks as $homework)
                        <div class="flex flex-col gap-3">
                            <div class="bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-lg p-5">

                                {{-- Title + Due Date --}}
                                <div class="flex items-start justify-between gap-3 mb-2">
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 font-serif leading-snug">
                                        {{ $homework->title }}
                                    </h3>
                                    @if($homework->due_date)
                                        <span class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300 whitespace-nowrap flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>
                                            </svg>
                                            {{ $homework->due_date }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Description --}}
                                @if($homework->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-3">
                                        {{ $homework->description }}
                                    </p>
                                @endif

                                {{-- Attached Files --}}
                                @if($homework->file && count($homework->file))
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($homework->file as $index => $file)
                                            <a
                                                href="/homework/{{ $homework->id }}/download/{{ $index }}"
                                                target="_blank"
                                                class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-md bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors duration-150"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                                                </svg>
                                                {{ $homework->file_names[$index] ?? basename($file) }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 text-gray-400 dark:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-3 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h4"/>
                            </svg>
                            <p class="text-sm">No homework yet. Add the first one!</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</x-app-layout>