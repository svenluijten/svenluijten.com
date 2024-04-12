@props(['page'])

<header class="text-center my-2">
    <picture>
        <img src="https://picsum.photos/640/144" alt="{{ $page->headerImageAlt }}" class="w-full h-36 mb-4" loading="lazy">
    </picture>

    <h1 class="text-4xl font-bold font-sans">{{ $page->title }}</h1>

    <div class="text-sm mt-4 dark:text-indigo-200">
        {{ $slot }}

        <time datetime="{{ $page->getDate('Y-m-d') }}" title="{{ $page->getDate('Y-m-d') }}" class="pill">
            <x-icons.calendar class="inline w-3 h-3 mb-1 align-middle fill-indigo-950 dark:fill-gray-200" />
            {{ $page->getDate('F jS, Y') }}
        </time>
    </div>
</header>
