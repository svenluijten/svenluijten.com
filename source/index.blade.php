@extends('_layouts.home')

@section('title', 'Home')

@section('body')
    <section class="flex items-center relative mb-8">
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

    <section id="blog" class="mb-6 p-4 text-lg border-indigo-700 border-l-4 border-b-4 border-t border-r">
        <header class="pb-2 flex justify-between items-center">
            <h2 class="text-2xl">Blog</h2>


            <div class="text-sm">
                <a href="{{ $page->link('feeds/posts.xml') }}">
                    <span class="sr-only">RSS</span>
                    <x-icons.rss />
                </a>
            </div>
        </header>

        <p class="my-2">
            I post some of my learnings as a developer, updates on projects I'm working on, and other things on
            <a href="{{ $page->link('posts') }}" class="link">my blog</a>. Below are the 5 most recent posts I've
            written, out of a total of {{ $posts->count() }}.
        </p>

        <ol class="my-2 list-disc ml-6">
            @foreach($posts->take(5) as $post)
                <li>
                    <a href="{{ $post->getUrl() }}"
                       title="{{ $post->excerpt }}"
                       class="link"
                    >
                        {{ $post->title }}
                    </a>
                </li>
            @endforeach
        </ol>
    </section>

    <section id="concerts" class="mb-6 p-4 text-lg border-indigo-700 border-l-4 border-b-4 border-t border-r">
        <header class="pb-2 flex justify-between items-center">
            <h2 class="text-2xl">Concerts</h2>

            <div class="text-sm">
                <a href="{{ $page->link('feeds/concerts.xml') }}">
                    <span class="sr-only">RSS</span>
                    <x-icons.rss />
                </a>
            </div>
        </header>

        <p>
            I love live music! In an effort to be more present at the shows I visit, I'm writing a little mini-review
            about every single one I attend in <a href="{{ $page->link('concerts') }}" class="link">my concert log</a>.
            Some of the most recent ones I've gone to:
        </p>

        <ol class="my-2 list-disc ml-6">
            @foreach ($concerts->take(5) as $concert)
                <li>
                    <a href="{{ $concert->getUrl() }}" class="link">{{ $concert->title }}</a>
                </li>
            @endforeach
        </ol>
    </section>
@endsection
