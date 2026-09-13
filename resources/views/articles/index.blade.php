<x-layout title="Articles" description="Articles I've written and published.">
    <x-slot:meta>
        <link href="{{ url('/feeds/articles.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten's Articles">
    </x-slot>

    <x-section title="Articles">
        <ol>
            @foreach ($articles as $article)
                <x-content-row
                    :href="route('articles.show', $article)"
                    :title="$article->title"
                    :date="$article->published_at"
                />
            @endforeach
        </ol>
    </x-section>
</x-layout>
