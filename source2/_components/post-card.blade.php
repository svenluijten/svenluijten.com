@php
    /** @var \App\Post $post */
@endphp

<article class="mb-4">
    <header class="text-2xl font-extrabold mb-1">
        <h2>
            <a href="{{ $post->getUrl() }}"
               class="border-b-4 border-indigo-200 text-black | hover:no-underline hover:text-black hover:border-indigo-600 | dark:text-indigo-100 dark:border-indigo-500 dark:hover:text-indigo-200">
                {{ $post->title }}
            </a>
        </h2>
    </header>

    <section class="text-gray-800 my-2 | dark:text-indigo-200">
        <p class="m-0">{!! $post->excerpt !!}</p>
    </section>

    <footer>
        <div class="text-sm text-gray-700 | dark:text-indigo-100">
            <span>Published on {{ $post->getDate('F jS, Y') }}</span>
            &mdash;
            <span class="italic">
                {{ $post->minutesToRead() }} {{ \Illuminate\Support\Str::plural('minute', $post->minutesToRead()) }} to read
            </span>
        </div>
    </footer>
</article>
