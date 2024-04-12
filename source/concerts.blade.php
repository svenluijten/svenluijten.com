@extends('_layouts.main')

@section('title', 'Concerts')

@section('content')
    <h1 class="sr-only">Concert log</h1>

    @foreach ($page->groupByYear($concerts) as $year => $concerts)
        <section>
            <h2 id="{{ $year }}" class="text-3xl text-center font-bold font-sans {{ $loop->first ? '' : 'mt-8' }}">{{ $year }}</h2>

            @foreach ($concerts as $concert)
                <article aria-labelledby="{{ $concert->id() }}" class="mb-6">
                    <h3 class="relative link font-sans">
                        <a href="{{ $concert->getUrl() }}" id="{{ $concert->id() }}" class="text-xl underline hover:no-underline peer">
                            {{ $concert->title }}
                        </a>
                        <span class="absolute -top-0 5 -left-3 5 font-bold text-xl invisible peer-hover:visible" aria-hidden="true">&rsaquo;</span>
                    </h3>

                    <footer class="text-indigo-950 dark:text-indigo-200 text-sm mt-2">
                        <span class="pill mr-1">
                            <x-icons.location class="inline w-3 h-3 mb-1 align-middle fill-indigo-950 dark:fill-gray-200" />
                            {{ $concert->venue }}, {{ $concert->city }} ({{ $concert->country }})

                        </span>

                        <time datetime="{{ $concert->getDate('Y-m-d H:i:s') }}" title="{{ $concert->getDate('Y-m-d') }}" class="pill">
                            <x-icons.calendar class="inline w-3 h-3 mb-1 align-middle fill-indigo-950 dark:fill-gray-200" />
                            {{ $concert->getDate('F jS, Y') }}
                        </time>
                    </footer>
                </article>
            @endforeach
        </section>
    @endforeach
@endsection
