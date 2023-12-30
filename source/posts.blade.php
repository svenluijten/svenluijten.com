@extends('_layouts.main')

@section('title', 'Blog Posts')

@section('content')
    <h1 class="sr-only">Blog posts</h1>

    @foreach ($posts as $post)
        <article aria-labelledby="{{ $post->id() }}" class="py-2 my-2">
            <h2 class="relative">
                <a href="{{ $post->getUrl() }}" id="{{ $post->id() }}" class="text-xl underline hover:no-underline peer">
                    {{ $post->title }}
                </a>
                <span class="absolute -top-0.5 -left-3.5 font-bold no-underline text-xl invisible peer-hover:visible" aria-hidden="true">&rsaquo;</span>
            </h2>

            <p>{{ $post->excerpt }}</p>

            <footer class="text-gray-600 text-sm">
                <time datetime="{{ $post->getDate('Y-m-d H:i:s') }}" title="{{ $post->getDate('Y-m-d') }}">
                    {{ $post->getDate('F jS, Y') }}
                </time>

                &bullet;

                <span>
                    About {{ $post->minutesToRead() }} {{ \Illuminate\Support\Str::plural('minute', $post->minutesToRead()) }} to read
                </span>
            </footer>
        </article>
    @endforeach
@endsection
