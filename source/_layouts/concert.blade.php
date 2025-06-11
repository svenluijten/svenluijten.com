@extends('_layouts.main')

@section('description', $page->title . ' in ' . $page->location . ', a mini-review.')

@section('content')
    <article class="dark:text-indigo-100">
        <h1 class="text-3xl font-bold text-center">{{ $page->title }}</h1>

        <header>
            <div class="text-sm text-gray-700 mt-4 text-center | dark:text-indigo-100">
                Published on <time datetime="{{ $page->getDate('Y-m-d') }}">{{ $page->getDate('F jS, Y') }}</time>
            </div>
        </header>

        <hr class="my-6 | dark:border-gray-900">

        <section class="post text-lg leading-relaxed">
            @yield('body')
        </section>

        <footer class="mt-6">
            <a href="{{ $page->link('concerts') }}">← Other concerts</a>
        </footer>
    </article>
@endsection
