<x-layout title="Sven Luijten">
    <section class="mb-6 font-text text-lg">
        <p>
            Hello! My name is <strong>Sven Luijten</strong>, and I am a developer with a passion for the web based in
            The Netherlands. I enjoy going to concerts and <a class="link" href="{{ route('concerts.index') }}">writing about my
            experiences there</a>, lifting heavy stuff in the gym, <a class="link" href="/projects">tinkering on side-projects</a>
            that may or may not ever see the light of day, and <a class="link" href="{{ route('articles.index') }}">sharing knowledge</a>
            I've picked up along the way.
        </p>
    </section>

    <x-section title="Articles">
        <ol>
            @foreach ($recentArticles as $article)
                <li class="flex flex-col md:flex-row md:justify-between mb-1">
                    <a
                        href="{{ route('articles.show', $article) }}"
                        class="underline underline-offset-4 decoration-2 decoration-primary hover:text-primary hover:decoration-secondary transition-colors duration-100"
                    >
                        {{ $article->title }}
                    </a>

                    <span class="text-gray-500 md:text-base text-sm">{{ $article->published_at->format('F jS, Y') }}</span>
                </li>
            @endforeach
        </ol>
    </x-section>

    <x-section title="Concerts">
        <ol class="md:-mx-8 mt-4 flex flex-col md:flex-row md:flex-wrap gap-4">
            @foreach ($recentConcerts as $concert)
                <li class="md:flex-1 md:min-w-[calc(50%-0.5rem)] shadow-md group">
                    <a href="{{ $concert->url }}">
                        <article class="bg-white flex flex-row rounded-lg">
                            <img src="https://picsum.photos/120" alt="" class="grayscale rounded-lg rounded-r-none group-hover:grayscale-0 transition-all duration-100">
                            <div class="py-1 px-2 flex flex-col justify-between">
                                <h2 class="font-system text-xl underline decoration-secondary decoration-2 line-clamp-2">{{ $concert->title }}</h2>
                                <span>{{ $concert->date->format('F jS, Y') }}</span>
                            </div>
                        </article>
                    </a>
                </li>
            @endforeach
        </ol>
    </x-section>
</x-layout>
