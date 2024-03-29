@extends('_layouts.main')

@section('title', 'Blog Posts')

@section('content')
    <h1 class="sr-only">Blog posts</h1>

    @foreach ($posts as $post)
        <a href="{{ $post->getUrl() }}" id="{{ $post->id() }}" class="group block py-2 my-2 px-4 -mx-4">
            <article aria-labelledby="{{ $post->id() }}" class="no-underline">
                <h2 class="relative text-xl link">
                    <span class="font-sans group-hover:no-underline underline">{{ $post->title }}</span>
                    <span class="absolute -top-0.5 -left-3.5 font-bold invisible group-hover:visible text-indigo-700" aria-hidden="true">&rsaquo;</span>
                </h2>

                <p>{{ $post->excerpt }}</p>

                <footer class="text-gray-600 dark:text-indigo-200 text-sm">
                    <time datetime="{{ $post->getDate('Y-m-d H:i:s') }}" title="{{ $post->getDate('Y-m-d') }}">
                        {{ $post->getDate('F jS, Y') }}
                    </time>

                    &bullet;

                    <span>
                        About {{ $post->minutesToRead() }} {{ str('minute')->plural($post->minutesToRead()) }} to read
                    </span>
                </footer>
            </article>
        </a>
    @endforeach
@endsection
