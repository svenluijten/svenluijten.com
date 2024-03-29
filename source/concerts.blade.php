@extends('_layouts.main')

@section('title', 'Concerts')

@section('content')
    <h1 class="sr-only">Concert log</h1>

    @foreach ($page->groupByYear($concerts) as $year => $concerts)
        <section>
            <h2 id="{{ $year }}" class="text-3xl text-center font-bold font-sans {{ $loop->first ? '' : 'mt-8' }}">{{ $year }}</h2>

            @foreach ($concerts as $concert)
                <article aria-labelledby="{{ $concert->id() }}" class="my-4">
                    <h3 class="relative link">
                        <a href="{{ $concert->getUrl() }}" id="{{ $concert->id() }}" class="text-lg underline hover:no-underline peer">
                            {{ $concert->title }}
                        </a>
                        <span class="absolute -top-0 5 -left-3 5 font-bold text-xl invisible peer-hover:visible" aria-hidden="true">&rsaquo;</span>
                    </h3>

                    <footer class="text-gray-600 dark:text-indigo-200 text-sm">
                    <span>
                        {{ $concert->venue }}, {{ $concert->city }} ({{ $concert->country }}) on
                    </span>

                        <time datetime="{{ $concert->getDate('Y-m-d H:i:s') }}" title="{{ $concert->getDate('Y-m-d') }}">
                            {{ $concert->getDate('F jS, Y') }}
                        </time>
                    </footer>
                </article>
            @endforeach
        </section>
    @endforeach
@endsection
