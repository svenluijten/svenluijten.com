@extends('_layouts.main')

@section('title', 'Archive')

@section('content')
    <h1 class="sr-only">Archive</h1>

    @foreach ($page->groupByYear([...$posts, ...$concerts]) as $year => $entries)
        <section>
            <h2 id="{{ $year }}" class="text-3xl font-bold {{ $loop->first ? '' : 'mt-8' }}">{{ $year }}</h2>

            <ol class="list-disc ml-6">
                @foreach ($entries as $entry)
                    <li>
                        <a href="{{ $entry->getUrl() }}" id="{{ $entry->id() }}" class="text-lg link">
                            {{ $entry->title }}
                        </a>
                    </li>
                @endforeach
            </ol>
        </section>
    @endforeach
@endsection
