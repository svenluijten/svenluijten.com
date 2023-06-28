@php
/** @var \TightenCo\Jigsaw\PageVariable $page */
@endphp

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
        <link rel="stylesheet" href="{{ mix('css/hljs-light.css', 'assets/build') }}" media="(prefers-color-scheme: light), (prefers-color-scheme: no-preference)">
        <link rel="stylesheet" href="{{ mix('css/hljs-dark.css', 'assets/build') }}" media="(prefers-color-scheme: dark)">

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
    {{--    <meta property="og:description" content="{{ isset($post) ? $post->excerpt : 'Hi 👋 — My name is Sven Luijten, and I am a full stack developer for the web.' }}">--}}
    {{--    <meta property="og:image" content="{{ isset($post) ? $post->getUrl() : 'misc' }}/card.png">--}}

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
            <main class="mx-auto w-full px-6 leading-relaxed text-xl dark:text-gray-100 | lg:w-3/5 lg:px-0">
                @yield('content')
            </main>
        </div>

        @include('_partials.footer')
    </body>

    <script src="{{ mix('js/main.js', 'assets/build') }}"></script>
</html>
