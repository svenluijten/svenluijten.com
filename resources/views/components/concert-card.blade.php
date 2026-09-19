@props(['concert'])

<li class="group">
    <a
        href="{{ $concert->url }}"
        class="flex h-full overflow-hidden rounded-card border border-line bg-surface shadow-card transition duration-150 | hover:border-line-strong hover:shadow-card-hover"
    >
        {{-- Decorative: the concert title sits right beside it. --}}
        <img
            src="{{ $concert->thumbnailUrl() }}"
            alt=""
            class="h-36 w-36 shrink-0 object-cover grayscale transition duration-200 group-hover:grayscale-0"
        >

        <div class="flex min-w-0 flex-col justify-between gap-2 px-4 py-3">
            <h3 class="line-clamp-2 text-xl underline decoration-secondary decoration-2 underline-offset-[3px]">
                {{ $concert->title }}
            </h3>

            <time datetime="{{ $concert->date->toDateString() }}" class="font-system text-sm text-ink-muted">
                {{ $concert->date->format('F jS, Y') }}
            </time>
        </div>
    </a>
</li>
