<x-layout title="Articles" description="Articles written and published by Sven.">
    <x-section title="Articles">
        <ol>
            @foreach ($articles as $article)
                <li class="flex flex-col md:flex-row md:justify-between mb-1">
                    <a href="{{ route('articles.show', $article) }}" class="link">
                        {{ $article->title }}
                    </a>

                    <span class="text-gray-500 md:text-base text-sm">{{ $article->published_at->format('F jS, Y') }}</span>
                </li>
            @endforeach
        </ol>
    </x-section>
</x-layout>
