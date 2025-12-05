<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{ $meta ?? '' }}

    <link href="{{ url('/feeds/all.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten">

    <x-meta.look-feel />

    @if(! app()->isProduction())
        <meta name="robots" content="noindex, nofollow">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Primary Meta Tags -->
    <title>{{ $title ?? 'Sven Luijten' }}</title>
    <meta name="title" content="{{ $title ?? 'Sven Luijten' }}">
    <meta name="description" content="{{ $description ?? 'todo: some default description' }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{!! oggy($title, $description) !!}">
    <meta property="og:image:alt" content="{{ $title . ' - ' . $description }}">
</head>

<body class="text-gray-900 antialiased border-8 border-primary bg-tertiary min-h-screen relative | md:border-0">
    <div class="flex flex-col min-h-screen">
        <x-header />

        <main class="container grow">
            <div class="mx-auto w-full px-6 | lg:w-2/3 md:py-6 lg:px-0">
                {{ $slot }}
            </div>
        </main>

        <x-footer />
    </div>
</body>
</html>
