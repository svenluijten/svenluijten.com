@props([
    'href',
    'title',
    'date',
])

<li class="flex flex-col gap-x-6 py-1 | md:flex-row md:items-baseline md:justify-between">
    <a href="{{ $href }}" class="link">{{ $title }}</a>

    <time datetime="{{ $date->toDateString() }}" class="shrink-0 font-system text-sm text-ink-muted">
        {{ $date->format('F jS, Y') }}
    </time>
</li>
