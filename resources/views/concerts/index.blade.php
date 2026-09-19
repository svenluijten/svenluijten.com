<x-layout title="Concerts" description="All the concerts I've been to." :paper="false" :sticky="true">
    <x-slot:meta>
        <link href="{{ url('/feeds/concerts.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten's Concert Log">
    </x-slot>

    {{-- Only the intro is on paper; the concert cards sit straight on the cream. --}}
    <x-paper class="mb-12">
        <p class="lead">
            I love going to concerts. In an effort to remember them better and actually be present when I'm at one, I
            write a recap of each of them in this concert log.
        </p>
    </x-paper>

    @foreach ($groupedConcerts as $year => $concerts)
        <x-section :title="$year">
            <ol class="my-4 grid grid-cols-1 gap-4 | md:grid-cols-2">
                @foreach ($concerts as $concert)
                    <x-concert-card :concert="$concert" />
                @endforeach
            </ol>
        </x-section>
    @endforeach
</x-layout>
