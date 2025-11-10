<x-layout :title="$article->title">
    <article>
        <header class="mb-8">
            <h1 class="text-5xl mb-2">{{ $article->title }}</h1>
            <p class="text-sm text-gray-600 uppercase">Published on {{ $article->published_at->format('F jS, Y') }}</p>
        </header>

        <hr class="w-24 border-2 border-secondary my-6">

        <main id="post-content">{!! $article->content !!}</main>

        <footer></footer>
    </article>
</x-layout>
