<x-layout :title="$concert->title">
    <article>
        <header class="mb-8">
            <h1 class="text-5xl mb-2">{{ $concert->title }}</h1>
            <p class="text-sm text-gray-600 uppercase">Published on {{ $concert->published_at->format('F jS, Y') }}</p>
        </header>

        <hr class="w-24 border-2 border-secondary my-6">

        <main id="post-content">{!! $concert->renderRichContent('content') !!}</main>

        <hr class="w-24 border-2 border-secondary my-6">

        <footer class="font-bold rounded-2xl border-2 border-primary border-dotted p-4 shadow-sm">
            <p class="text-sm">
                Subscribe to <a href="/feeds" class="link">the RSS feed</a> if you want to be updated whenever new
                articles are posted.
            </p>
        </footer>
    </article>
</x-layout>
