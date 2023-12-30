@extends('_layouts.main')

@section('title', $page->title)

@section('content')
    <article>
        <x-page-header :page="$page" />

        <section id="post-content" class="prose-lg">
            @yield('body')
        </section>

        <x-page-footer title="More posts" :page="$page" />
    </article>
@endsection
