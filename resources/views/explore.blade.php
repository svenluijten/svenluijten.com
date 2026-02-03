<x-layout title="Explore" description="A non-exhaustive list of content on this site.">
    <p class="text-xl mb-4">
        Here's a non-exhaustive list of pages on this website. Call it a "sitemap", call it an "index", whatever you want.
    </p>

    <x-section title="Articles">
        <a href="{{ route('articles.index') }}" class="link">My written articles</a> are intended to educate and inform. They tend to
        be longer(ish) and are well refined. Their target audience is mostly (PHP) developers looking to expand their knowledge and
        learn new things.
    </x-section>

    <x-section title="Concert log">
        <a href="{{ route('concerts.index') }}" class="link">My concert log</a> is the place where I catalogue every concert
        I've been to. In an effort to be more present at the shows I visit and hopefully remember them a bit better than by
        just a few blurry pictures and videos, I write about my experience there.
    </x-section>

    <x-section title="Blog">
        I write on <a href="{{ route('blog.index') }}" class="link">my blog</a> about topics that interest me in that moment.
        These random thoughts can generate new ideas, help me find like-minded people online, and clarify  my thinking about
        any given subject. Topics might range from development tips or things I've learned, to thoughts on an article or other
        blog post I read online, to just about anything I'm thinking about at the time.
    </x-section>

    <x-section title="Feeds">
        <p>This site automatically publishes a handful of feeds for every content type, as well as a generic one that contains everything.</p>

        <ul class="list-disc my-4 ml-4">
            <li><a href="{{ url('/feeds/all.xml') }}" class="link"><code class="code">/feeds/all.xml</code></a> contains all content published on this site.</li>
            <li><a href="{{ url('/feeds/articles.xml') }}" class="link"><code class="code">/feeds/articles.xml</code></a> contains only the articles I write.</li>
            <li><a href="{{ url('/feeds/concerts.xml') }}" class="link"><code class="code">/feeds/concerts.xml</code></a> only contains the concert logs.</li>
            <li><a href="{{ url('/feeds/blog-posts.xml') }}" class="link"><code class="code">/feeds/blog-posts.xml</code></a> only contains my blog posts.</li>
        </ul>

        <p>This same list can be found on <a href="{{ route('feeds.index') }}" class="link">the dedicated <code class="code">/feeds</code> page</a>.</p>
    </x-section>
</x-layout>
