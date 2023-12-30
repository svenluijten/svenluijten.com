@extends('_layouts.main')

@section('title', $page->title)

@section('content')
    <article>
        <x-page-header :page="$page">
            <span>
                {{ $page->venue }}, {{ $page->city }} ({{ $page->country }})
            </span>
        </x-page-header>

        <section id="post-content" class="prose lg:prose-xl">
            @yield('body')
        </section>

        <x-page-footer title="More concerts" :page="$page" />
    </article>
@endsection
