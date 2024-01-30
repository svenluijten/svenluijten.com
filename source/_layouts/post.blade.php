@extends('_layouts.main')

@section('title', $page->title)

@push('styles')
    <link rel="stylesheet" href="{{ mix('css/hljs-light.css', 'assets/build') }}" media="(prefers-color-scheme: light), (prefers-color-scheme: no-preference)">
    <link rel="stylesheet" href="{{ mix('css/hljs-dark.css', 'assets/build') }}" media="(prefers-color-scheme: dark)">
@endpush

@push('scripts')
    <script src="{{ mix('js/hljs.js', 'assets/build') }}"></script>
@endpush

@section('content')
    <article>
        <x-page-header :page="$page" />

        <x-separator color="indigo-700" />

        <section id="post-content" class="prose lg:prose-xl dark:prose-invert">
            @yield('body')
        </section>

        <x-separator color="indigo-700" />

        <x-page-footer title="More posts" :page="$page" />
    </article>
@endsection
