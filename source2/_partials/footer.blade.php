<footer class="container mx-auto">
    <div class="mx-auto w-full flex flex-row justify-between py-4 px-6 | lg:w-2/3 lg:px-0">
        <div>
            <a href="{{ $page->link('/') }}">Sven Luijten</a>
            <span class="text-black | dark:text-indigo-100">&copy; {{ $page->buildTime->format('Y') }}</span>
        </div>

        <nav class="flex | sm:mt-0">
            <a href="https://github.com/svenluijten" target="_blank" rel="noreferrer me author">
                GitHub
            </a>

            <a href="{{ $page->link('feeds/all.xml') }}" class="ml-4">
                RSS
            </a>
        </nav>
    </div>
</footer>
