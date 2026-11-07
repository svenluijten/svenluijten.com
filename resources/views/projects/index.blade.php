<x-layout title="Projects" description="Projects and tools I've built and/or maintain." :paper="false" :sticky="true">
    <x-paper class="mb-12">
        <p class="lead">
            A small collection of projects and tools I've built and/or maintain.
        </p>
    </x-paper>

    <ol class="space-y-12">
        @foreach ($projects as $project)
            <li>
                <x-paper>
                    <h2 class="text-2xl">
                        <a href="{{ $project->url }}" class="link" target="_blank" rel="noopener noreferrer">{{ $project->name }}</a>
                    </h2>

                    <p class="mt-1 font-system text-sm text-ink-muted">{{ rtrim(Str::after($project->url, '://'), '/') }}</p>

                    <p class="mt-3 font-text text-lg leading-relaxed text-pretty">{{ $project->summary }}</p>
                </x-paper>
            </li>
        @endforeach
    </ol>
</x-layout>
