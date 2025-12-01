<x-layout title="Concerts">
    <section class="mb-6 font-text text-lg">
        <p>
            I write stuff and I publish it here.
        </p>
    </section>

    <x-section title="Concerts">
        @foreach ($groupedConcerts as $year => $concerts)
            <h2>{{ $year }}</h2>

            <ol class="md:-mx-8 my-4 flex flex-col md:flex-row md:flex-wrap gap-4">
                @foreach ($concerts as $concert)
                    <li class="md:flex-1 md:min-w-[calc(50%-0.5rem)] shadow-md group">
                        <a href="{{ $concert->url }}">
                            <article class="bg-white flex flex-row rounded-lg">
                                <img src="{{ $concert->thumbnailUrl() }}" alt="{{ $concert->getFirstMedia() }}" class="grayscale rounded-lg rounded-r-none group-hover:grayscale-0 transition-all duration-100 object-cover h-36 w-36">
                                <div class="py-1 px-2 flex flex-col justify-between">
                                    <h2 class="font-system text-xl underline decoration-secondary decoration-2 line-clamp-2">{{ $concert->title }}</h2>
                                    <span>{{ $concert->date->format('F jS, Y') }}</span>
                                </div>
                            </article>
                        </a>
                    </li>
                @endforeach
            </ol>
        @endforeach
    </x-section>
</x-layout>
