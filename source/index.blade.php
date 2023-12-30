@extends('_layouts.home')

@section('title', 'Home')

@section('body')
    <h1>Hi 👋 &mdash; My name is Sven</h1>
    <p>
        Some always-truths about me: I am <a href="">a developer for the web</a>, <a href="">occasional blog post writer</a>, <a href="">enjoyer of concerts</a>, and <a href="">photography enthusiast</a>.
        Visit <a href="">my <code>now</code> page</a> to see what I'm up to at the moment.
    </p>

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
@endsection
