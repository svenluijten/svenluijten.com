@php
/** @var \TightenCo\Jigsaw\PageVariable $page */
@endphp

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        @section('meta')
            <link href="{{ $page->link('/feeds/all.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten">
        @show

        @include('_partials.meta')

        <link rel="canonical" href="{{ $page->getUrl() }}">

        @if(! $page->production)
            <meta name="robots" content="noindex, nofollow">
        @endif

        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
        <link rel="stylesheet" href="{{ mix('css/hljs-light.css', 'assets/build') }}" media="(prefers-color-scheme: light), (prefers-color-scheme: no-preference)">
        <link rel="stylesheet" href="{{ mix('css/hljs-dark.css', 'assets/build') }}" media="(prefers-color-scheme: dark)">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;800&display=swap" rel="stylesheet">

        <!-- Primary Meta Tags -->
        <title>{{ $page->title }}</title>
        <meta name="title" content="{{ $page->title }}">
        <meta name="description" content="@yield('description', $page->excerpt ?? $page->description)">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ $page->getUrl() }}">
        <meta property="og:title" content="{{ $page->title }}">
        <meta property="og:description" content="@yield('description', $page->excerpt ?? $page->description)">
        <meta property="og:image" content="@yield('social-image', $page->link('/assets/images/card.jpg'))" id="social-img-og">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary">
        <meta property="twitter:url" content="{{ $page->getUrl() }}">
        <meta property="twitter:title" content="{{ $page->title }}">
        <meta property="twitter:description" content="@yield('description', $page->excerpt ?? $page->description)">
        <meta property="twitter:creator" content="@svenluijten">
        <meta property="twitter:image" content="@yield('social-image', $page->link('/assets/images/card.jpg'))" id="social-img-tw">
    </head>

    <body class="font-sans text-sm text-gray-900 antialiased border-8 border-gray-200 bg-white min-h-screen relative | dark:bg-gray-800 dark:border-gray-900 lg:border-0">
        @include('_partials.header')

        <main id="post-content" class="container">
            <div class="mx-auto w-full px-6 md:text-lg dark:text-gray-100 | lg:w-2/3 md:py-6 lg:px-0">
                @yield('content')
            </div>
        </main>

        @include('_partials.footer')
    </body>

    <script src="{{ mix('js/main.js', 'assets/build') }}"></script>
</html>
