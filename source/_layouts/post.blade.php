<article class="container mx-auto | dark:text-indigo-100">
    <div class="mx-auto w-full py-4 px-6 | lg:w-3/5 md:py-12 lg:px-0">
        <header>
            <h1 class="text-4xl font-bold text-center">{{ $post->title() }}</h1>

            <div class="text-sm text-gray-700 mt-4 text-center | dark:text-indigo-100">
                <span>Published on {{ $post->getDate('F jS, Y') }}</span>
                &mdash;
                <span class="italic">
                    {{ $post->minutesToRead() }} {{ \Illuminate\Support\Str::plural('minute', $post->minutesToRead()) }} to read
                </span>
            </div>
        </header>

        <hr class="my-8 | dark:border-gray-900">

        <main>
            <x-markdown flavor="github" class="post">
                {!! $post->body() !!}
            </x-markdown>
        </main>

        <footer class="mt-8">
            @if($previous = $post->previous())
                <div class="flex justify-between items-center mb-6">
                    <hr class="flex-1 border-indigo-100 | dark:border-gray-900">
                    <div class="text-center text-sm text-gray-600 px-2 | dark:text-indigo-100">Previous Post</div>
                    <hr class="flex-1 border-indigo-100 | dark:border-gray-900">
                </div>

                <x-post-card :post="$previous"/>
            @elseif($next = $post->next())
                <div class="flex justify-between items-center mb-6">
                    <hr class="flex-1 border-indigo-100 | dark:border-gray-900">
                    <div class="text-center text-sm text-gray-600 px-2 | dark:text-indigo-100">Next Post</div>
                    <hr class="flex-1 border-indigo-100 | dark:border-gray-900">
                </div>

                <x-post-card :post="$next"/>
            @endif
        </footer>
    </div>
</article>
