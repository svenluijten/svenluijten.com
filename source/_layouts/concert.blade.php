@extends('_layouts.main')

@section('title', $page->title)

@section('content')
    <article>
        <x-page-header :page="$page">
            <span>
                {{ $page->venue }}, {{ $page->city }} ({{ $page->country }})
            </span>
        </x-page-header>

        <hr class="my-6 | dark:border-gray-950">

        <section id="post-content" class="prose lg:prose-xl dark:prose-invert">
            @yield('body')
        </section>

        <x-page-footer title="More concerts" :page="$page" />
    </article>
@endsection
