@props(['page'])

<header class="text-center my-2">
    <picture>
        <img src="https://picsum.photos/640/144" alt="{{ $page->headerImageAlt }}" class="w-full h-36 mb-4" loading="lazy">
    </picture>

    <h1 class="text-4xl font-bold font-sans">{{ $page->title }}</h1>

    <div class="text-sm mt-4 dark:text-gray-400">
        {{ $slot }}

        <time datetime="{{ $page->getDate('Y-m-d') }}" title="{{ $page->getDate('Y-m-d') }}">
            {{ $page->getDate('F jS, Y') }}
        </time>
    </div>
</header>
