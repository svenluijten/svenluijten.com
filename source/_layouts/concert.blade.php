@extends('_layouts.main')

@section('title', $page->title)

@section('content')
    <article>
        <x-page-header :page="$page">
            <span class="pill mr-1">
                <x-icons.location class="inline w-3 h-3 mb-1 align-middle fill-indigo-950 dark:fill-gray-200" />
                {{ $page->venue }}, {{ $page->city }} ({{ $page->country }})
            </span>
        </x-page-header>

        <hr class="my-6 | dark:border-gray-950">

        <section id="post-content" class="">
            @yield('body')
        </section>

        <x-page-footer title="More concerts" :page="$page" />
    </article>
@endsection
