@extends('_layouts.main')

@section('title', 'Feeds')

@section('content')
    <h1 class="sr-only">Feeds</h1>

    <p class="mb-4">
        I'm a staunch believer in owning your own content and distributing them via open standards, which is why all my
        content is published in Atom feeds. Below is an overview of the feeds this site currently supports:
    </p>

    <table class="w-full border border-slate-400">
        <thead>
            <tr>
                <th class="text-left px-4 py-2 w-1/2 border border-slate-600">Feed link</th>
                <th class="text-left px-4 py-2 w-1/2 border border-slate-600">Description</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td class="p-4 w-1/2"><a href="{{ $page->link('feeds/all.xml') }}"><code>/feeds/all.xml</code></a></td>
                <td class="p-4 w-1/2">All content published on this site.</td>
            </tr>

            <tr>
                <td class="p-4 w-1/2"><a href="{{ $page->link('feeds/posts.xml') }}"><code>/feeds/posts.xml</code></a></td>
                <td class="p-4 w-1/2">My blog posts.</td>
            </tr>

            <tr>
                <td class="p-4 w-1/2"><a href="{{ $page->link('feeds/concerts.xml') }}"><code>/feeds/concerts.xml</code></a></td>
                <td class="p-4 w-1/2">My concert logs entries.</td>
            </tr>
        </tbody>
    </table>
@endsection
