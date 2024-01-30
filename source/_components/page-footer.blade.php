@props(['title', 'page'])

<footer class="my-4">
    <h1 class="text-sm text-center uppercase text-gray-500 mb-4">
        {{ $title }}
    </h1>

    <nav role="menu" aria-label="Previous and next post(s) if available" class="flex flex-col md:flex-row justify-between gap-4">
        @if ($page->previous())
            <a href="{{ $page->previous()->getUrl() }}" class="flex-1 block border border-indigo-300 hover:border-indigo-600 py-2 px-4 rounded group">
                <div class="text-xs text-gray-500 text-left">
                    <span class="group-hover:text-indigo-500 group-hover:font-bold">&lsaquo;</span> Previous
                </div>
                {{ $page->previous()->title }}
            </a>
        @endif

        @if ($page->next())
            <a href="{{ $page->next()->getUrl() }}" class="flex-1 block border border-indigo-300 hover:border-indigo-600 py-2 px-4 rounded group">
                <div class="text-xs text-gray-500 text-right">
                    Next <span class="group-hover:text-indigo-500 group-hover:font-bold">&rsaquo;</span>
                </div>
                {{ $page->next()->title }}
            </a>
        @endif
    </nav>
</footer>
