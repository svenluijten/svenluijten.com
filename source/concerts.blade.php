---
title: Concerts
---

@extends('_layouts.main')

@php
    /** @var \App\Concert[] $concerts */
@endphp

@section('meta')
    <link href="{{ $page->link('/feeds/concerts.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten Concert Posts">
    @parent
@endsection

@section('social-image', $page->link('/assets/images/card-concerts.jpg'))

@section('content')
    <ol>
        @foreach ($page->groupByYear($concerts) as $year => $concerts)
            <h1 class="text-3xl font-bold" id="{{ $year }}">{{ $year }}</h1>

            <ol class="mb-4 flex flex-col">
                @foreach($concerts as $concert)
                    <li class="rounded-lg border-2 border-indigo-300 my-2 bg-indigo-50 dark:bg-indigo-900 hover:bg-indigo-100 dark:hover:bg-indigo-800 transition-all hover:mb-3 hover:mt-1 shadow hover:shadow-lg">
                        <a href="{{ $concert->getUrl() }}" class="p-4 block">
                            <article>
                                <h2 class="font-bold text-xl">{{ $concert->title }}</h2>
                                <p>📍 {{ $concert->location }}</p>
                            </article>
                        </a>
                    </li>
                @endforeach
            </ol>
        @endforeach
    </ol>
@endsection
