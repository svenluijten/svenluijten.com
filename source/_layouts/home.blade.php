@extends('_layouts.main')

@section('title', $page->title)

@section('content')
    <section>
        @yield('body')
    </section>
@endsection
