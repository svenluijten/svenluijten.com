@php
/** @var \TightenCo\Jigsaw\PageVariable $page */
@endphp

{{--<!DOCTYPE html>--}}
{{--<html lang="{{ $page->language ?? 'en' }}">--}}
{{--    <head>--}}
{{--        <meta charset="utf-8">--}}
{{--        <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--        <link rel="canonical" href="{{ $page->getUrl() }}">--}}
{{--        <meta name="description" content="{{ $page->description }}">--}}
{{--        <title>{{ $page->title }}</title>--}}
{{--        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">--}}
{{--        <script defer src="{{ mix('js/main.js', 'assets/build') }}"></script>--}}
{{--    </head>--}}
{{--    <body class="text-gray-900 font-sans antialiased">--}}
{{--        @yield('body')--}}
{{--    </body>--}}
{{--</html>--}}







<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{--    @include('feed::links')--}}

    {{--    @include('meta.look')--}}

        <link rel="canonical" href="{{ $page->getUrl() }}">

        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/github.min.css" media="(prefers-color-scheme: light), (prefers-color-scheme: no-preference)">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/dracula.min.css" media="(prefers-color-scheme: dark)">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;800&display=swap" rel="stylesheet">

        <!-- Primary Meta Tags -->
        <title>{{ $page->title }}</title>
        <meta name="title" content="{{ $page->title }}">
        <meta name="description" content="{{ $page->description }}">

        <!-- Open Graph / Facebook -->
    {{--    <meta property="og:type" content="website">--}}
    {{--    <meta property="og:url" content="{{ $page->getUrl() }}">--}}
    {{--    <meta property="og:title" content="{{ $page->title }}">--}}
    {{--    <meta property="og:description" content="{{ isset($post) ? $post->excerpt() : 'Hi 👋 — My name is Sven Luijten, and I am a full stack developer for the web.' }}">--}}
    {{--    <meta property="og:image" content="https://rawcdn.githack.com/svenluijten/assets/HEAD/{{ isset($post) ? $post->slug() : 'misc' }}/card.png">--}}

        <!-- Twitter -->
    {{--    <meta property="twitter:card" content="summary">--}}
    {{--    <meta property="twitter:url" content="{{ rtrim(config('app.url'), '/') . request()->getPathInfo() }}">--}}
    {{--    <meta property="twitter:title" content="{{ $title }}">--}}
    {{--    <meta property="twitter:description" content="{{ isset($post) ? $post->excerpt() : 'Hi 👋 — My name is Sven Luijten, and I am a full stack developer for the web.' }}">--}}
    {{--    <meta property="twitter:image" content="https://rawcdn.githack.com/svenluijten/assets/HEAD/{{ isset($post) ? $post->slug() : 'misc' }}/card.png">--}}
    {{--    <meta property="twitter:creator" content="@svenluijten">--}}
    </head>

    <body class="font-sans text-base text-gray-900 antialiased border-8 border-gray-300 bg-white min-h-screen relative | dark:bg-gray-800 dark:border-gray-900 lg:border-0">
        @include('_partials.header')

        <div class="container mx-auto">
            <div class="mx-auto w-full py-4 px-6 | lg:w-3/5 md:py-12 lg:px-0">
                @yield('content')
            </div>
        </div>

        @include('_partials.footer')
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/languages/dockerfile.min.js"></script>
    <script type="text/javascript">hljs.initHighlightingOnLoad();</script>
</html>
