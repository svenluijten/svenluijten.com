<x-layout :title="$concert->title" description="A mini review of the show in {{ $concert->venue?->name }}, {{ $concert->venue?->city }}">
    <x-slot:meta>
        <link href="{{ url('/feeds/concerts.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten's Concert Log">
    </x-slot>

    <x-post :title="$concert->title" :published-at="$concert->published_at" feed="concerts">
        {!! $concert->rendered_content !!}
    </x-post>
</x-layout>
