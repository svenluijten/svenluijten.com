<x-layout title="Concerts" description="All the concerts I've been to.">
    <x-slot:meta>
        <link href="{{ url('/feeds/concerts.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten's Concert Log">
    </x-slot>

    <p class="mb-10 font-text text-xl leading-relaxed">
        I love going to concerts. In an effort to remember them better and actually be present when I'm at one, I
        write a recap of each of them in this concert log.
    </p>

    @foreach ($groupedConcerts as $year => $concerts)
        <x-section :title="$year">
            <ol class="my-4 grid grid-cols-1 gap-4 | md:paper-breakout md:grid-cols-2">
                @foreach ($concerts as $concert)
                    <x-concert-card :concert="$concert" />
                @endforeach
            </ol>
        </x-section>
    @endforeach
</x-layout>
