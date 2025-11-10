<footer class="bg-primaryLight border-t-primary border-t-2 font-sans text-white font-semibold">
    <div class="container mx-auto">
        <div class="mx-auto w-full flex flex-row justify-between py-4 px-6 | lg:w-2/3 lg:px-0">
            <div>
                <a href="{{ route('home') }}">Sven Luijten</a>
                <span class="text-black | dark:text-indigo-100">&copy; {{ now()->format('Y') }}</span>
            </div>

            <nav class="flex | sm:mt-0">
                <a href="https://github.com/svenluijten" target="_blank" rel="noreferrer me author">
                    GitHub
                </a>

                <a href="/feeds/all.xml" class="ml-4">
                    RSS
                </a>
            </nav>
        </div>
    </div>
</footer>
