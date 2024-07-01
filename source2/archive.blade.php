---
title: Archive
---

@extends('_layouts.main')

@section('meta')
    <link href="{{ $page->link('/feeds/all.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten Posts">
    @parent
@endsection

@section('content')
    <ul>
        @foreach ($page->groupByYear([...$posts, ...$concerts]) as $year => $articles)
            <h1 class="text-3xl font-bold" id="{{ $year }}">{{ $year }}</h1>

            <ul class="mb-4">
                @foreach($articles as $post)
                    <li class="list-disc ml-6">
                        <a href="{{ $post->getUrl() }}">{{ $post->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </ul>
@endsection
