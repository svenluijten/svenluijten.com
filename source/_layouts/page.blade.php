@extends('_layouts.main')

@section('title', $page->title)

@section('content')
    <article>
        <header class="text-center my-2">
            <picture>
                <img src="{{ $page->headerImage()->source() }}" alt="{{ $page->headerImage()->alt() }}" class="w-full h-36 mb-4 object-cover" loading="lazy">
            </picture>

            <h1 class="text-3xl font-bold font-sans mb-4">{{ $page->title }}</h1>
            @if (isset($page->last_updated))
                <div class="text-sm my-4 dark:text-gray-400">
                    Last updated:

                    <time datetime="{{ $page->last_updated->format('Y-m-d') }}" title="{{ $page->last_updated->format('Y-m-d') }}">
                        {{ $page->last_updated->format('Ymd') }}
                    </time>
                </div>
            @endif

            <p>
                {!! $page->description_html !!}
            </p>
        </header>

        <x-separator color="indigo-700" />

        <main id="post-content">
            @yield('body')
        </main>
    </article>
@endsection
