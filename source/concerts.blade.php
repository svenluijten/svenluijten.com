@extends('_layouts.main')

@section('title', 'Concerts')

@section('content')
    <h1>Concert log</h1>

    @foreach ($page->groupByYear($concerts) as $year => $concerts)
        <h2 id="{{ $year }}">{{ $year }}</h2>

        @foreach ($concerts as $concert)
            <article aria-labelledby="{{ $concert->id() }}">
                <h3>
                    <a href="{{ $concert->getUrl() }}" id="{{ $concert->id() }}">
                        {{ $concert->title }}
                    </a>
                </h3>

                <footer>
                    <span>
                        {{ $concert->venue }}, {{ $concert->city }} ({{ $concert->country }})
                    </span>

                    <time datetime="{{ $concert->getDate('Y-m-d H:i:s') }}">
                        {{ $concert->getDate('F jS, Y') }}
                    </time>
                </footer>
            </article>
        @endforeach
    @endforeach
@endsection
