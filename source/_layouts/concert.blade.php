@extends('_layouts.main')

@section('title', $page->title)

@section('content')
    <article>
        <header>
            <h1>{{ $page->title }}</h1>

            <span>
                {{ $page->venue }}, {{ $page->city }} ({{ $page->country }})
            </span>

            <time datetime="{{ $page->getDate('Y-m-d') }}" title="{{ $page->getDate('Y-m-d') }}">{{ $page->getDate('F jS, Y') }}</time>

            <span>
                {{ $page->minutesToRead() }} {{ \Illuminate\Support\Str::plural('minute', $page->minutesToRead()) }} to read
            </span>
        </header>

        <section id="post-content">
            @yield('body')
        </section>

        <footer>
            <h1 id="more-concerts">More concerts</h1>
            <nav aria-label="Previous and next post(s) if available">
                <ul role="menu" aria-labelledby="more-concerts">
                    @if ($page->previous())
                        <li>
                            Previous: <a href="{{ $page->previous()->getUrl() }}">{{ $page->previous()->title }}</a>
                        </li>
                    @endif

                    @if ($page->next())
                        <li>
                            Next: <a href="{{ $page->next()->getUrl() }}">{{ $page->next()->title }}</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </footer>
    </article>
@endsection
