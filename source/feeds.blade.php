@extends('_layouts.main')

@section('title', 'Feeds')

@section('content')
    <header class="text-center my-2">
        <picture>
            <img src="https://picsum.photos/640/144" alt="..." class="w-full h-36 mb-4" loading="lazy">
        </picture>


        <h1 class="text-3xl font-bold mb-4">Feeds</h1>
        <p>
            In an attempt to
            <a class="link" target="_blank" href="https://marcus.io/blog/making-rss-more-visible-again-with-slash-feeds">make RSS more visible again</a>,
            this page lists all the feeds published for content on this website.
        </p>
    </header>

    <x-separator color="indigo-700" />

    <main class="prose dark:prose-invert">
        <h2>RSS</h2>
        <ul>
            <li>
                <a href="{{ $page->link('feeds/all.xml') }}"><code class="inline">/feeds/all.xml</code></a>
                All content published on this site.
            </li>

            <li>
                <a href="{{ $page->link('feeds/posts.xml') }}"><code class="inline">/feeds/posts.xml</code></a>
                My blog posts.
            </li>

            <li>
                <a href="{{ $page->link('feeds/concerts.xml') }}"><code class="inline">/feeds/concerts.xml</code></a>
                My concert logs entries.
            </li>
        </ul>

        <h2>Atom</h2>
        <p>If you prefer Atom feeds, I have those too!</p>
        <ul>
            <li>
                <a href="{{ $page->link('feeds/all.atom') }}"><code class="inline">/feeds/all.atom</code></a>
                All content published on this site.
            </li>

            <li>
                <a href="{{ $page->link('feeds/posts.atom') }}"><code class="inline">/feeds/posts.atom</code></a>
                My blog posts.
            </li>

            <li>
                <a href="{{ $page->link('feeds/concerts.atom') }}"><code class="inline">/feeds/concerts.atom</code></a>
                My concert logs entries.
            </li>
        </ul>

        <h2>JSON</h2>
        <p>
            I also publish the feeds as <a href="https://www.jsonfeed.org">JSON Feed</a> for the three people in the
            world that use it.
        </p>
        <ul>
            <li>
                <a href="{{ $page->link('feeds/all.json') }}"><code class="inline">/feeds/all.json</code></a>
                All content published on this site.
            </li>

            <li>
                <a href="{{ $page->link('feeds/posts.json') }}"><code class="inline">/feeds/posts.json</code></a>
                My blog posts.
            </li>

            <li>
                <a href="{{ $page->link('feeds/concerts.json') }}"><code class="inline">/feeds/concerts.json</code></a>
                My concert logs entries.
            </li>
        </ul>
    </main>
@endsection
