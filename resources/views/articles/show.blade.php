<x-layout :title="$article->title" :description="$article->summary ?? ''">
    <x-slot:meta>
        @if (request()->route()->getName() === 'posts.show')
            <link rel="canonical" href="{{ route('articles.show', $article) }}">
        @endif

        <link href="{{ url('/feeds/articles.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten's Articles">
    </x-slot>

    <x-post :title="$article->title" :published-at="$article->published_at" feed="articles">
        {!! $article->rendered_content !!}
    </x-post>
</x-layout>
