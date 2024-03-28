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
    <ul>
        @foreach ($page->groupByYear($concerts) as $year => $concerts)
            <h1 class="text-3xl font-bold" id="{{ $year }}">{{ $year }}</h1>

            <ul class="mb-4">
                @foreach($concerts as $concert)
                    <li class="list-disc ml-6">
                        <a href="{{ $concert->getUrl() }}">{{ $concert->title }} in {{ $concert->location }}</a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </ul>
@endsection
