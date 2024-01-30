@extends('_layouts.home')

@section('title', 'Home')

@section('body')
    <section class="flex items-center relative">
        <img src="/assets/images/headshot.jpg"
             alt="A headshot of an insanely handsome developer looking at the camera with a strapping smile."
             class="w-32 h-32 rounded-full border-4 border-gray-100 dark:border-gray-700 | lg:absolute lg:-left-36"
        >

        <div class="ml-4 lg:ml-0">
            <h1 class="text-3xl font-bold mb-2">Hi 👋 &mdash; My name is Sven!</h1>
            <p class="text-lg">
                I am <a href="https://github.com/svenluijten" class="link">a developer for the web</a>,
                <a href="{{ $page->link('posts') }}" class="link">occasional blog post writer</a>,
                <a href="{{ $page->link('concerts') }}" class="link">enjoyer of concerts</a>, and
                <a href="https://luijten.photography" class="link">photography enthusiast</a>. If you'd like to see what
                I'm up to now, go visit <a href="{{ $page->link('now') }}" class="link">my <code>now</code> page</a>.
            </p>
        </div>
    </section>

    <x-separator color="indigo-700" />

    <section>
        <h2>Blog</h2>
        <p>This is where I write about my learnings as a developer and post updates about my open source projects. Here are the 5 most recent articles:</p>

        <ol>
            @foreach($posts->take(5) as $post)
                <li>
                    <a href="{{ $post->getUrl() }}">{{ $post->title }}</a>
                </li>
            @endforeach
        </ol>

        <p>
            You can <a href="{{ $page->link('posts') }}">visit the overview page</a> for {{ $posts->count() - 5 }} more
            {{ str('post')->plural($posts->count() - 5) }}, or <a href="{{ $page->link('feeds/posts.xml') }}">subscribe to the RSS feed here</a>.
        </p>
    </section>

    <section>
        <h2>Concerts</h2>
        <p>
            I love live music. In an effort to be more present at the shows I visit, I'm writing a little mini-review about
            every single one I attend. Some of the most recent ones I've gone to:
        </p>

        <ol>
            @foreach ($concerts->take(5) as $concert)
                <li>
                    <a href="{{ $concert->getUrl() }}">{{ $concert->title }}</a>
                </li>
            @endforeach
        </ol>

        <p>
            Check out <a href="{{ $page->link('concerts') }}">the concerts page</a> for an overview of all {{ $concerts->count() }}
            shows I've been to. You can also <a href="{{ $page->link('feeds/concerts.xml') }}">subscribe to the RSS feed here</a>.
        </p>
    </section>
@endsection
