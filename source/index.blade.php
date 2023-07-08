@extends('_layouts.main')

@section('content')
    <div class="flex flex-row justify-center items-start w-[100vw] -ml-8 bg-gray-200 p-2 | dark:bg-gray-900 sm:w-auto sm:ml-0 sm:bg-inherit">
        <img src="{{ $page->link('/assets/images/headshot.jpg') }}"
             alt="A headshot of an insanely handsome developer looking at the camera with a strapping smile."
             class="w-24 h-24 my-4 mr-4 rounded-full border-4 border-gray-100 shadow | lg:mr-0 lg:my-0 lg:-ml-36 lg:w-32 lg:h-32 dark:border-gray-700"
        >

        <div class="lg:px-4">
            <h1 class="text-2xl font-bold lg:text-3xl">Hi 👋 — My name is Sven</h1>
            <p class="text-xl">
                I am a full-stack developer for the web, photographer, and lifter of heavy things. I <a
                        href="{{ $page->link('posts') }}">write blog posts</a>, <a
                        href="{{ $page->link('concerts') }}">go to concerts</a>, and <a
                        href="https://instagram.com/luijten.photography">photograph animals</a>.
            </p>
        </div>
    </div>

    <section class="py-4 leading-relaxed" id="blog">
        <h2 class="text-2xl font-bold">
            <a href="{{ $page->link('posts') }}" class="text-black hover:text-black relative group | dark:text-gray-100 dark:hover:text-indigo-100">
                <span class="absolute -left-8 invisible group-hover:visible hidden md:inline-block">&rarr;</span> Blog
            </a>
        </h2>

        <p class="mb-4">
            This is where I write technical articles about my learnings, what's happening in my career as a full-stack
            developer, and the occasional random showerthought. Here are my 5 most recent articles:
        </p>

        <ul class="mb-4 list-disc ml-6">
            @foreach ($posts->take(5) as $post)
                <li>
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

    <section class="py-4 leading-relaxed" id="concerts">
        <h2 class="text-2xl font-bold">
            <a href="{{ $page->link('concerts') }}" class="text-black hover:text-black relative group | dark:text-gray-100 dark:hover:text-indigo-100">
                <span class="absolute -left-8 invisible group-hover:visible hidden md:inline-block">&rarr;</span> Concert log
            </a>
        </h2>

        <p class="mb-4">
            I'm an avid music enjoyer, and so I visit a lot of concerts. This is my attempt to log every show I go to
            with a bite-sized review. Some of the most recent shows I've gone to:
        </p>

        <ul class="mb-4 list-disc ml-6">
            @foreach ($concerts->take(5) as $concert)
                <li>
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
