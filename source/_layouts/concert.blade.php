@extends('_layouts.main')

@section('description', $page->title . ' in ' . $page->location . ', a mini-review.')

@section('content')
    <article class="dark:text-indigo-100 post">
        <header>
            <h1 class="text-4xl font-bold text-center">{{ $page->title }}</h1>

            <div class="text-sm text-gray-700 mt-4 text-center | dark:text-indigo-100">
                <span>{{ $page->getDate('F jS, Y') }}</span>
                &mdash;
                <span class="italic">
                    {{ $page->minutesToRead() }} {{ \Illuminate\Support\Str::plural('minute', $page->minutesToRead()) }} to read
                </span>
            </div>
        </header>

        <hr class="my-8 | dark:border-gray-900">

        @yield('body')

        <footer class="mt-4">
            <a href="{{ $page->link('concerts') }}">← Other concerts</a>
        </footer>
    </article>
@endsection
