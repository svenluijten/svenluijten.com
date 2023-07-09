---
title: Blog posts
---

@extends('_layouts.main')

@php
    /** @var \App\Post[] $posts */
@endphp

@section('meta')
    <link href="{{ $page->link('/feeds/posts.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten's blog posts">
    @parent
@endsection

@section('social-image', $page->link('/assets/images/card-posts.jpg'))

@section('content')
    @foreach ($posts as $post)
        <x-post-card :post="$post" />
    @endforeach
@endsection
