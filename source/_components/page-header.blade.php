@props(['page'])

<header>
    <h1>{{ $page->title }}</h1>

    {{ $slot }}

    <time datetime="{{ $page->getDate('Y-m-d') }}" title="{{ $page->getDate('Y-m-d') }}">{{ $page->getDate('F jS, Y') }}</time>
</header>
