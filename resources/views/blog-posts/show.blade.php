<x-layout :title="$blogPost->title" description="">
    <x-slot:meta>
        <link href="{{ url('/feeds/blog.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten's Blog Posts">
    </x-slot>

    <article>
        <header class="mb-8">
            <h1 class="text-5xl mb-2">{{ $blogPost->title }}</h1>
            <p class="text-sm text-gray-600 uppercase">Published on {{ $blogPost->published_at->format('F jS, Y') }}</p>
        </header>

        <hr class="w-24 border-2 border-secondary my-6">

        <main id="post-content" class="paper-stack">
            {!! $blogPost->rendered_content !!}
        </main>

        <hr class="w-24 border-2 border-secondary my-6">

        <footer class="font-bold rounded-2xl border-2 border-primary border-dotted p-4 shadow-sm my-6">
            <p class="text-sm">
                Subscribe to <a href="/feeds" class="link">the RSS feed</a> if you want to be updated whenever new
                blog posts are posted.
            </p>
        </footer>
    </article>

    <image-carousel></image-carousel>
    <image-lightbox></image-lightbox>
</x-layout>
