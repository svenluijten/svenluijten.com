<footer class="bg-primary-light border-t-primary border-t-2 font-sans text-white font-semibold">
    <div class="container mx-auto">
        <div class="mx-auto w-full flex flex-row justify-between py-4 px-6 | lg:w-2/3 lg:px-0">
            <div>
                <a href="{{ route('home') }}" class="link">Sven Luijten</a>
                <span>&copy; {{ now()->format('Y') }}</span>
            </div>

            <nav class="flex | sm:mt-0">
                <a href="https://github.com/svenluijten" target="_blank" rel="noreferrer me author" class="link">
                    GitHub
                </a>

                <a href="/feeds" class="ml-4 link">
                    Feeds
                </a>
            </nav>
        </div>
    </div>
</footer>
