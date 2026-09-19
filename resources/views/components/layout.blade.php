@props([
    'title',
    'description',
    // Pages that place their own paper sheets, or none at all, turn off the page-wide one.
    'paper' => true,
    // Whether the header stays pinned and fades as the page scrolls over it.
    // Defaults to the page-wide sheet, but pages placing their own sheets set it
    // themselves: having paper to slide over is a separate question from whether
    // the layout is the one providing it.
    'sticky' => null,
])

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
    <title>{{ $title }} - Sven</title>
    <meta name="title" content="{{ $title }}">
    <meta name="description" content="{{ $description }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{!! oggy($title, $description) !!}">
    <meta property="og:image:alt" content="{{ $title . ' - ' . $description }}">
</head>

<body class="min-h-screen bg-tertiary font-system text-ink antialiased">
    <div class="flex min-h-screen flex-col">
        <x-header :sticky="$sticky ?? $paper" />

        {{-- Positioned and after the sticky header, so the paper paints over it. --}}
        <main class="relative grow py-4">
            <x-container>
                @if ($paper)
                    <x-paper>{{ $slot }}</x-paper>
                @else
                    {{ $slot }}
                @endif
            </x-container>
        </main>

        <x-footer />
    </div>
</body>
</html>
