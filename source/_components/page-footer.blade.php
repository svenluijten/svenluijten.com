@props(['title', 'page'])

<footer class="my-4">
    <h1 class="text-sm text-center uppercase text-gray-500 mb-4">
        {{ $title }}
    </h1>

    <nav role="menu" aria-label="Previous and next post(s) if available" class="flex flex-col md:flex-row justify-between gap-4">
        @if ($page->previous())
            <a href="{{ $page->previous()->getUrl() }}" class="flex-1 border border-indigo-300 hover:border-indigo-600 py-2 px-4 rounded group | flex justify-between items-start">
                <div class="text-xl text-gray-500 text-left self-center group-hover:text-indigo-500 group-hover:font-bold mr-2">&lsaquo;</div>
                <div class="flex flex-col text-right">
                     <span class="text-gray-500">Previous</span>
                    {{ $page->previous()->title }}
                </div>
            </a>
        @endif

        @if ($page->next())
            <a href="{{ $page->next()->getUrl() }}" class="flex-1 border border-indigo-300 hover:border-indigo-600 py-2 px-4 rounded group | flex justify-between items-start">
                <div class="flex flex-col text-left">
                    <span class="text-gray-500">Next</span>
                    {{ $page->next()->title }}
                </div>
                <div class="text-xl text-gray-500 text-right self-center group-hover:text-indigo-500 group-hover:font-bold ml-2">&rsaquo;</div>
            </a>
        @endif
    </nav>
</footer>
