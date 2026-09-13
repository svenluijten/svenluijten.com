<x-layout title="Archive" description="All of the content I've published over the years.">
    @foreach ($items as $year => $group)
        <x-section title="{{ $year }}">
            <ol class="ml-5 list-disc space-y-1">
                @foreach ($group as $item)
                    <li>
                        <a href="{{ $url($item) }}" class="link">{{ $item->title }}</a>
                    </li>
                @endforeach
            </ol>
        </x-section>
    @endforeach
</x-layout>
