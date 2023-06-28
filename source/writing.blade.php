@extends('_layouts.main')

@php
/** @var \TightenCo\Jigsaw\Collection\CollectionItem[] $devPosts */
@endphp

@section('content')
    @foreach ($devPosts as $post)
        <article class="mb-8">
            <header class="text-3xl font-extrabold mb-1">
                <h2>
                    <a href="{{ $post->getUrl() }}" class="border-b-4 border-indigo-200 text-black | dark:text-indigo-100 dark:border-indigo-500 hover:text-indigo-50 hover:bg-indigo-500 hover:border-indigo-600">
                        {{ $post->title }}
                    </a>
                </h2>
            </header>

            <section class="text-gray-800 text-xl my-2 | dark:text-indigo-200">
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
