<x-layout :title="$blogPost->title" :description="$blogPost->preview">
    <x-slot:meta>
        <link href="{{ url('/feeds/blog-posts.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten's Blog Posts">
    </x-slot>

    <x-post :title="$blogPost->title" :published-at="$blogPost->published_at" feed="blog-posts">
        {!! $blogPost->rendered_content !!}
    </x-post>
</x-layout>
