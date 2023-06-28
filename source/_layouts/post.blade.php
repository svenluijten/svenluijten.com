@extends('_layouts.main')

@section('content')
    <article class="dark:text-indigo-100 post">
        <header>
            <h1 class="text-4xl font-bold text-center">{{ $page->title }}</h1>

            <x-post-meta class="mt-4 text-center" :post="$page" />
        </header>

        <hr class="my-8 | dark:border-gray-900">

        @yield('body')

        <footer class="mt-8">
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
