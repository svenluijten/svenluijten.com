@extends('_layouts.main')

@section('title', 'Feeds')

@section('content')
    <h1 class="sr-only">Feeds</h1>

    <p class="mb-4">
        I'm a staunch believer in owning your own content and distributing it via open standards, which is why all my
        content is published in Atom and RSS feeds. Below is an overview of the feeds this site currently supports:
    </p>

    <ul class="list-disc ml-4">
        <li>
            All content published on this site.
            <a href="{{ $page->link('feeds/all.xml') }}"><code>/feeds/all.xml</code></a>
        </li>

        <li>
            <a href="{{ $page->link('feeds/posts.xml') }}"><code>/feeds/posts.xml</code></a>
            My blog posts.
        </li>

        <li>
            <a href="{{ $page->link('feeds/concerts.xml') }}"><code>/feeds/concerts.xml</code></a>
            My concert logs entries.
        </li>
    </ul>

@endsection
