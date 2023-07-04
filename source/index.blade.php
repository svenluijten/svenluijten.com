@extends('_layouts.main')

@section('content')
    <div class="flex flex-col justify-center items-start mb-4 lg:flex-row">
        <img src="/assets/images/headshot.jpg"
             alt="A headshot of an insanely handsome developer looking at the camera with a strapping smile."
             class="w-36 h-36 my-4 rounded-full border-4 border-gray-100 shadow | lg:my-0 lg:-ml-36 lg:w-32 lg:h-32 dark:border-gray-700"
        >

        <div class="lg:px-4">
            <h1 class="text-3xl font-bold">Hi 👋 — My name is Sven</h1>
            <p>
                I am a full-stack developer for the web, photographer, and lifter of heavy things. I <a
                        href="{{ $page->link('posts') }}">write blog posts</a>, <a
                        href="{{ $page->link('concerts') }}">go to concerts</a>, and <a
                        href="https://instagram.com/luijten.photography">photograph animals</a>.
            </p>
        </div>
    </div>

    <section class="py-4" id="blog">
        <h2 class="text-3xl font-bold">
            <a href="{{ $page->link('posts') }}" class="text-black hover:text-black relative group | dark:text-gray-100 dark:hover:text-indigo-100">
                <span class="absolute -left-8 invisible group-hover:visible">&rarr;</span> Blog
            </a>
        </h2>

        <p class="mb-4">
            This is where I write technical articles about my learnings, what's happening in my career as a full-stack
            developer, and the occasional random showerthought. Here are my 5 most recent articles:
        </p>

        <ul class="mb-4">
            @foreach ($posts->take(5) as $post)
                <li class="list-disc ml-6">
                    <a href="{{ $post->getUrl() }}">{{ $post->title }}</a>
                </li>
            @endforeach
        </ul>

        <p>
            You can <a href="{{ $page->link('posts') }}">visit the overview page</a> for {{ $posts->count() - 5 }} more
            {{ \Illuminate\Support\Str::plural('article', $posts->count() - 5) }}, or <a
                    href="{{ $page->link('feeds/posts.xml') }}">subscribe to the RSS feed here</a>.
        </p>
    </section>

    <section class="py-4" id="concerts">
        <h2 class="text-3xl font-bold">
            <a href="{{ $page->link('concerts') }}" class="text-black hover:text-black relative group | dark:text-gray-100 dark:hover:text-indigo-100">
                <span class="absolute -left-8 invisible group-hover:visible">&rarr;</span> Concert log
            </a>
        </h2>

        <p class="mb-4">
            As a big music lover, I visit a lot of concerts. This is my attempt to log every show I go to with a
            bite-sized review. Some of the most recent shows I've gone to:
        </p>

        <ul class="mb-4">
            @foreach ($concerts->take(5) as $concert)
                <li class="list-disc ml-6">
                    <a href="{{ $concert->getUrl() }}">{{ $concert->title }} ({{ $concert->getDate('Y') }})</a>
                </li>
            @endforeach
        </ul>

        <p>
            Check out <a href="{{ $page->link('concerts') }}">the concerts page</a> for an overview of all
            {{ $concerts->count() }} shows I've been to. You can also <a
                    href="{{ $page->link('feeds/concerts.xml') }}">subscribe to the RSS feed here</a>.
        </p>
    </section>
@endsection
