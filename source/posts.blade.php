---
title: Blog posts
---

@extends('_layouts.main')

@php
    /** @var \App\Post[] $posts */
@endphp

@section('meta')
    <link href="{{ $page->link('/feeds/posts.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten's blog posts">
    @parent
@endsection

@section('social-image', $page->link('/assets/images/card-posts.jpg'))

@section('content')
    @foreach ($posts as $post)
        <article class="mb-4">
            <header class="text-2xl font-extrabold mb-1">
                <h2>
                    <a href="{{ $post->getUrl() }}"
                       class="border-b-4 border-indigo-200 text-black | hover:no-underline hover:text-black hover:border-indigo-600 | dark:text-indigo-100 dark:border-indigo-500 dark:hover:text-indigo-200">
                        {{ $post->title }}
                    </a>
                </h2>
            </header>

            <section class="text-gray-800 my-2 | dark:text-indigo-200">
                <p>{!! $post->excerpt !!}</p>
            </section>

            <footer>
                <div class="text-sm text-gray-700 | dark:text-indigo-100">
                    <span>Published on {{ $post->getDate('F jS, Y') }}</span>
                    &mdash;
                    <span class="italic">
                        {{ $post->minutesToRead() }} {{ \Illuminate\Support\Str::plural('minute', $post->minutesToRead()) }} to read
                    </span>
                </div>
            </footer>
        </article>
    @endforeach
@endsection
