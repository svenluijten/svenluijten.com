@props([
    'title',
    'publishedAt',
    'feed',
])

@php
    // Keyed by the generated feed filename (see App\Console\Commands\GenerateFeeds).
    $feedLabel = match ($feed) {
        'articles' => 'articles',
        'concerts' => 'concert log',
        'blog-posts' => 'blog',
    };
@endphp

<article>
    <header class="mb-8">
        <h1 class="mb-3">{{ $title }}</h1>

        <p class="font-system text-sm uppercase tracking-wide text-ink-muted">
            Published on
            <time datetime="{{ $publishedAt->toDateString() }}">{{ $publishedAt->format('F jS, Y') }}</time>
        </p>
    </header>

    <hr class="w-16 border-t-2 border-secondary my-8">

    <main id="post-content" class="prose">{{ $slot }}</main>

    <hr class="w-16 border-t-2 border-secondary my-8">

    <footer class="mt-8 rounded-card border border-line bg-tertiary/40 p-4">
        <p class="font-system text-sm">
            Subscribe to <a href="{{ url("/feeds/{$feed}.xml") }}" class="link">the {{ $feedLabel }} feed</a> to
            get new posts in your reader, or <a href="{{ route('feeds.index') }}" class="link">browse every
            feed</a> this site publishes.
        </p>
    </footer>
</article>

<image-carousel></image-carousel>
<image-lightbox></image-lightbox>
