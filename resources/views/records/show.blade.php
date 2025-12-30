<x-layout :title="$record->title" :description="$record->comment ?? 'Vinyl record from my collection'">
    <article class="record-detail">
        <header class="mb-8">
            <h1 class="text-5xl mb-2">{{ $record->title }}</h1>

            @if ($record->artists->isNotEmpty())
                <p class="text-2xl text-gray-600 mb-2">
                    {{ $record->artists->pluck('name')->join(', ') }}
                </p>
            @endif

            @if ($record->discogs_release_code)
                <p class="text-sm text-gray-500">
                    <a
                        href="https://www.discogs.com/release/{{ ltrim($record->discogs_release_code, 'r') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="link"
                    >
                        View on Discogs
                    </a>
                </p>
            @endif
        </header>

        <hr class="w-24 border-2 border-secondary my-6">

        @if ($record->comment)
            <section class="font-text text-lg mb-8">
                <p class="whitespace-pre-wrap">{{ $record->comment }}</p>
            </section>
            <hr class="w-24 border-2 border-secondary my-6">
        @endif

        @if ($record->getMedia('album-cover')->isNotEmpty())
            <section class="mb-8">
                <h2 class="text-2xl mb-4">Album Cover</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($record->getMedia('album-cover') as $media)
                        <img
                            src="{{ $media->getUrl() }}"
                            alt="{{ $record->title }} - Album Cover"
                            class="rounded-xl border-8 border-white shadow-lg cursor-pointer record-image"
                        >
                    @endforeach
                </div>
            </section>
        @endif

        @if ($record->getMedia('backside')->isNotEmpty())
            <section class="mb-8">
                <h2 class="text-2xl mb-4">Backside</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($record->getMedia('backside') as $media)
                        <img
                            src="{{ $media->getUrl() }}"
                            alt="{{ $record->title }} - Backside"
                            class="rounded-xl border-8 border-white shadow-lg cursor-pointer record-image"
                        >
                    @endforeach
                </div>
            </section>
        @endif

        @if ($record->getMedia('inside')->isNotEmpty())
            <section class="mb-8">
                <h2 class="text-2xl mb-4">Inside</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($record->getMedia('inside') as $media)
                        <img
                            src="{{ $media->getUrl() }}"
                            alt="{{ $record->title }} - Inside"
                            class="rounded-xl border-8 border-white shadow-lg cursor-pointer record-image"
                        >
                    @endforeach
                </div>
            </section>
        @endif

        @if ($record->getMedia('vinyl-photos')->isNotEmpty())
            <section class="mb-8">
                <h2 class="text-2xl mb-4">Vinyl Photos</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($record->getMedia('vinyl-photos') as $media)
                        <img
                            src="{{ $media->getUrl() }}"
                            alt="{{ $record->title }} - Vinyl Photo"
                            class="rounded-xl border-8 border-white shadow-lg cursor-pointer record-image"
                        >
                    @endforeach
                </div>
            </section>
        @endif
    </article>

    <image-lightbox></image-lightbox>
</x-layout>
