<x-layout title="Sven Luijten" description="Homepage of Sven's personal website.">
    <section class="mb-10 font-text text-xl leading-relaxed">
        <p>
            Hello! My name is <strong>Sven Luijten</strong>, and I am a developer with a passion for the web based in
            The Netherlands. I enjoy going to concerts and <a class="link" href="{{ route('concerts.index') }}">writing about my
            experiences there</a>, lifting heavy stuff in the gym, <a href="{{ route('blog.index') }}" class="link">sharing
            my thoughts on my blog</a>, and <a class="link" href="{{ route('articles.index') }}">writing longer form articles</a>
            to share what I've learned.
        </p>
    </section>

    <x-section title="Articles">
        <ol>
            @foreach ($recentArticles as $article)
                <x-content-row
                    :href="route('articles.show', $article)"
                    :title="$article->title"
                    :date="$article->published_at"
                />
            @endforeach
        </ol>

        <a href="{{ route('articles.index') }}" class="group mt-4 inline-block font-semibold">
            <span class="inline-block font-normal text-primary transition-all duration-100 group-hover:animate-pulse">&rarr;</span>
            See all articles&hellip;
        </a>
    </x-section>

    <x-section title="Concerts">
        <ol class="my-4 grid grid-cols-1 gap-4 | md:paper-breakout md:grid-cols-2">
            @foreach ($recentConcerts as $concert)
                <x-concert-card :concert="$concert" />
            @endforeach
        </ol>

        <a href="{{ route('concerts.index') }}" class="group inline-block font-semibold">
            <span class="inline-block font-normal text-primary transition-all duration-100 group-hover:animate-pulse">&rarr;</span>
            See all concerts&hellip;
        </a>
    </x-section>

    <x-section title="Blog">
        <ol>
            @foreach ($recentBlogPosts as $blogPost)
                <x-content-row
                    :href="route('blog.show', $blogPost)"
                    :title="$blogPost->title"
                    :date="$blogPost->published_at"
                />
            @endforeach
        </ol>

        <a href="{{ route('blog.index') }}" class="group mt-4 inline-block font-semibold">
            <span class="inline-block font-normal text-primary transition-all duration-100 group-hover:animate-pulse">&rarr;</span>
            See all blog posts&hellip;
        </a>
    </x-section>
</x-layout>
