<x-layout title="Music Cabinet" description="My vinyl record collection.">
    <section class="mb-6 font-text text-lg">
        <p>
            My collection of vinyl records that I've accumulated over time. I started collecting in 2020 as a pandemic
            hobby, and I've never truly stopped.
        </p>
    </section>

    <x-section>
        <div class="album-grid">
            @foreach ($records as $record)
                <div
                    class="album-cover-item {{ $loop->iteration % 4 === 0 ? 'featured' : '' }}"
                    data-title="{{ $record->title }}"
                    @if ($record->artists->isNotEmpty())
                        data-artist="{{ $record->artists->pluck('name')->join(', ') }}"
                    @endif
                >
                    @if ($record->getFirstMedia('album-cover'))
                        <img
                            src="{{ $record->thumbnailUrl() }}"
                            alt="{{ $record->title }}"
                            class="album-cover-image"
                            loading="lazy"
                        >
                    @else
                        <div class="album-cover-placeholder">
                            <span>No Cover</span>
                        </div>
                    @endif
                    <div class="album-cover-tooltip">
                        <div class="tooltip-title">{{ $record->title }}</div>
                        @if ($record->artists->isNotEmpty())
                            <div class="tooltip-artist">{{ $record->artists->pluck('name')->join(', ') }}</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </x-section>
</x-layout>
