@extends('_layouts.main')

@section('content')
    <article class="dark:text-indigo-100">
        <h1 class="text-3xl font-bold text-center mt-4 sm:mt-0">{{ $page->title }}</h1>

        <header>
            <div class="text-sm text-gray-700 mt-4 text-center | dark:text-indigo-100">
                <span>
                    Published on
                    <time datetime="{{ $page->getDate('Y-m-d') }}">{{ $page->getDate('F jS, Y') }}</time>
                </span>
            </div>
        </header>

        <hr class="my-6 | dark:border-gray-900">

        <section class="post">
            @yield('body')
        </section>

        <footer class="mt-6">
            @if($previous = $page->previous())
                <div class="flex justify-between items-center mb-6">
                    <hr class="flex-1 border-indigo-100 | dark:border-gray-900">
                    <div class="text-center text-sm text-gray-600 px-2 | dark:text-indigo-100">Previous Post</div>
                    <hr class="flex-1 border-indigo-100 | dark:border-gray-900">
                </div>

                <x-post-card :post="$previous"/>
            @elseif($next = $page->next())
                <div class="flex justify-between items-center mb-6">
                    <hr class="flex-1 border-indigo-100 | dark:border-gray-900">
                    <div class="text-center text-sm text-gray-600 px-2 | dark:text-indigo-100">Next Post</div>
                    <hr class="flex-1 border-indigo-100 | dark:border-gray-900">
                </div>

                <x-post-card :post="$next"/>
            @endif
        </footer>
    </article>
@endsection
