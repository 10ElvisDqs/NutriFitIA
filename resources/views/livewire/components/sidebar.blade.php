<div id="application-sidebar"
     class="hs-overlay [--auto-close:lg] hs-overlay-open:translate-x-0 -translate-x-full duration-300 transform hidden fixed top-0 left-0 bottom-0 z-[60] w-64 bg-white dark:bg-neutral-900 border-e border-gray-200 dark:border-neutral-700 shadow-lg overflow-y-auto lg:block lg:translate-x-0">
    <nav class="hs-accordion-group h-full flex flex-col p-6 space-y-4" data-hs-accordion-always-open>
        <!-- Logo -->
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">{{ config('app.name', 'NutriFitIA') }}</h1>
        </div>

        <!-- List -->
        <ul class="space-y-2">
            <li wire:click="new">
                <a class="flex items-center gap-x-3 py-2 px-4 text-sm font-medium text-gray-700 dark:text-neutral-300 rounded-lg bg-gradient-to-r from-red-500 to-pink-600 shadow hover:shadow-lg hover:from-red-600 hover:to-pink-700 hover:text-white transition-all duration-200"
                   href="#">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"/>
                        <path d="M12 5v14"/>
                    </svg>
                    New chat
                </a>
            </li>
            @foreach($conversations as $conversation)
                <li>
                    {{-- <a href="{{ route('chat.show', $conversation) }}"
                       class="flex items-center gap-x-3 py-2 px-4 text-sm font-medium text-gray-600 dark:text-neutral-400 rounded-lg bg-gradient-to-r from-gray-200 to-gray-300 dark:from-neutral-800 dark:to-neutral-700 shadow hover:bg-gray-100 dark:hover:bg-neutral-800 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
                        {{ $conversation->title ?? 'New Chat' }}
                    </a> --}}
                </li>
            @endforeach
        </ul>
        <!-- End List -->
    </nav>
</div>
