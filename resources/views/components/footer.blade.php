<footer class="mt-16 border-t-4 border-primary bg-primary-light font-system text-white">
    <x-container class="flex flex-row justify-between py-5">
        <div>
            <a href="{{ route('home') }}" class="link">Sven Luijten</a>
            <span>&copy; {{ now()->format('Y') }}</span>
        </div>

        <nav class="flex gap-6">
            <a href="https://github.com/svenluijten" target="_blank" rel="noreferrer me author" class="link">
                GitHub
            </a>

            <a href="{{ route('feeds.index') }}" class="link">
                Feeds
            </a>
        </nav>
    </x-container>
</footer>
